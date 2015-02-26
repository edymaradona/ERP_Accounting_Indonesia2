<?php

class GEssController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2left';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'rights',
            'ajaxOnly + calendarEvents, DepartmentCalendarAjax, updateLeaveAjax, updateAttendanceAjax',
        ];
    }

    private function loadId()
    {
        $model = gPerson::model()->find('userid = ' . Yii::app()->user->id);

        if ($model === null)
            throw new CHttpException(404, 'SSO has not set yet. Please, contact admin..');

        return $model;
    }

    private function loadSubordinateId($id)
    {
        $model = gPerson::model()->findByPk((int)$id);

        //if ($model->mSuperiorId() == null || $model->mDoubleSuperiorId() == null )
        //    throw new CHttpException(401, 'You are not authorized to open this page.');

        if ($model->mSuperiorId() != sUser::model()->currentPersonId() && $model->mDoubleSuperiorId() != sUser::model()->currentPersonId())
            throw new CHttpException(401, 'You are not authorized to open this page.');

        return $model;
    }

    public function actionIndex()
    {
        $model = $this->loadId();
        $month = 0;
        $year = 0;

        $id = 5; //bugs forum

        $forum = Forum::model()->findByPk($id);

        $threadsProvider = new CActiveDataProvider('Thread', [
            'criteria' => [
                'condition' => 'forum_id=' . $forum->id,
            ],
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);


        if ($model != null) {
            $id = $model->id;
            $this->render('index', [
                'model' => $this->loadModel($id),
                'month' => $month,
                'year' => $year,
                'threadsProvider' => $threadsProvider,
            ]);
        } else
            $this->render('index', [
                'month' => $month,
                'year' => $year,
            ]);
    }

    public function actionLeave($id = 1)
    {

        $model = $this->loadId();
        $month = 0;
        $year = 0;

        $connection = Yii::app()->db;
        $_md = date('Y') . "-" . date("m", strtotime($model->companyfirst->start_date)) . "-" . date("d", strtotime($model->companyfirst->start_date));

        //if (strtotime($_md) < time()) {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $model->id);
        $criteria->compare('approved_id', 9);

        $firstyear = new CDbCriteria;
        $firstyear->compare('year(start_date)', date('Y', strtotime($model->companyfirst->start_date)));
        $firstyear->mergeWith($criteria);

        $first = gLeave::model()->find($firstyear);
        if ($first == null) {
            $_first = date("Y-m-d", strtotime($model->companyfirst->start_date));

            $sql = "insert into g_leave 
				(parent_id, input_date, year_leave , number_of_day, start_date , end_date  , leave_reason  , balance, remark, approved_id,superior_approved_id) VALUES 
				(" . $model->id . "  ,'" . $_first . "' ,0,0,'" . $_first . "'  ,'" . $_first . "' ,'Auto Generated Leave',
				0,'Auto Generated Leave',9,9)";
            $command = $connection->createCommand($sql)->execute();
        }

        $currentyear = new CDbCriteria;
        $currentyear->compare('year(start_date)', date('Y'));
        $currentyear->mergeWith($criteria);

        $current = gLeave::model()->find($currentyear);
        if ($current == null && strtotime($_md) < time()) {

            if (isset($model->leaveBalance) && $model->leaveBalance->balance <= -1) {
                $balance = $model->leaveBalance->balance;
            } else
                $balance = 0;

            $new_balance = 12 + $balance;

            $sql = "insert into g_leave 
				(parent_id, input_date, year_leave , number_of_day, start_date , end_date  , leave_reason  , balance, remark, approved_id,superior_approved_id) VALUES 
				(" . $model->id . "  ,'" . $_md . "' ," . $new_balance . "," . $new_balance . ",'" . $_md . "'  ,'" . $_md . "' ,'Auto Generated Leave',
				" . $new_balance . ",'Auto Generated Leave',9,9)";
            $command = $connection->createCommand($sql)->execute();
        }
        //}

        $this->render('leave', [
            'model' => $this->loadModel($id),
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionSubordinate($id, $month = 0)
    {
        $this->loadId();
        $this->loadSubordinateId($id);
        //$month=0;
        $year = 0;

        $this->render('subordinate', [
            'model' => $this->loadModelSubordinate($id),
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionLeaveSuperiorApproved($id, $pid)
    {
        $this->loadId();
        $model = $this->loadSubordinateId($pid);

        gLeave::model()->updateByPk((int)$id, [
            'superior_approved_id' => 2,
            'updated_date' => time(),
            'updated_by' => Yii::app()->user->id
        ]);

        $modelLeave = gLeave::model()->findByPk((int)$id);

        $this->newInbox([
            'recipient' => $model->userid,
            'subject' => "Superior Leave Approved. Your Leave has been approved by Your Superior",
            'message' => "Dear " . $model->employee_name . ",<br/> <br/>
			Your leave request start on " . $modelLeave->start_date . " and will end at " . $modelLeave->end_date . " for: \"" . $modelLeave->leave_reason . "\" has been approved by your superior. <br/> 
			Thank You.. <br/><br/>"
        ]);

        $this->newInbox([
            'recipient' => Yii::app()->user->id,
            'subject' => "Sub Ordinate Leave Approved. Leave of " . $model->employee_name . " has been approved by you",
            'message' => "Dear " . Yii::app()->user->name . ",<br/><br/> 
			Leave request of your subordinate, " . $model->employee_name . " start on " . $modelLeave->start_date . " and will end at " . $modelLeave->end_date .
                " for: \"" . $modelLeave->leave_reason . "\" has been approved by you. <br/><br/>You received this notification is for security reason to
			avoid possibility approval by other people. If this happen, report to HR department and change your password immediately...<br/> 
			Thank You.. <br/><br/>"
        ]);

        $modelN = new sNotification;
        $modelN->group_id = 1;
        $modelN->link = 'm1/gLeave/view/id/' . $model->id;
        $modelN->content = 'Leave Approved by Superior. Leave of <read>' . $model->employee_name . '</read> 
        on ' . $modelLeave->start_date . ' has been approved by: ' . sUser::model()->currentPerson()->employee_name;
        $modelN->photo_path = $model->photoPath;
        $modelN->save(false);

    }

    public function actionLeaveSuperiorRejected($id, $pid)
    {
        $this->loadId();
        $model = $this->loadSubordinateId($pid);

        gLeave::model()->updateByPk((int)$id, [
            'superior_approved_id' => 3, //Rejected
            'approved_id' => 3, //Rejected
            'updated_date' => time(),
            'updated_by' => Yii::app()->user->id
        ]);

        $modelLeave = gLeave::model()->findByPk((int)$id);

        $this->newInbox([
            'recipient' => $model->userid,
            'subject' => "Superior Leave Rejected. Your Leave has been rejected by Your Superior",
            'message' => "Dear " . $model->employee_name . ",<br/> <br/>
			Your leave request start on " . $modelLeave->start_date . " and will end at " . $modelLeave->end_date . " for: \"" . $modelLeave->leave_reason . "\" has been rejected by your superior. <br/> 
			Thank You.. <br/><br/>"
        ]);

        $this->newInbox([
            'recipient' => Yii::app()->user->id,
            'subject' => "Sub Ordinate Leave Rejected. Leave of " . $model->employee_name . " has been rejected by you",
            'message' => "Dear " . Yii::app()->user->name . ",<br/> <br/>
			Leave request of your subordinate, " . $model->employee_name . " start on " . $modelLeave->start_date . " and will end at " . $modelLeave->end_date .
                " for: \"" . $modelLeave->leave_reason . "\" has been rejected by you. <br/>
			Thank You.. <br/><br/>"
        ]);

        $modelN = new sNotification;
        $modelN->group_id = 1;
        $modelN->link = 'm1/gLeave/view/id/' . $model->id;
        $modelN->content = 'Leave Rejected by Superior. Leave of <read>' . $model->employee_name . '</read> 
        on ' . $modelLeave->start_date . ' has been rejected by: ' . sUser::model()->currentPerson()->employee_name;
        $modelN->photo_path = $model->photoPath;
        $modelN->save(false);

    }

    public function actionPermissionSuperiorApproved($id, $pid)
    {
        $this->loadId();
        $model = $this->loadSubordinateId($pid);

        gPermission::model()->updateByPk((int)$id, [
            'superior_approved_id' => 2,
            'updated_date' => time(),
            'updated_by' => Yii::app()->user->id
        ]);

        $modelPermission = gPermission::model()->findByPk((int)$id);

        $this->newInbox([
            'recipient' => $model->userid,
            'subject' => "Superior Permission Approved. Your Permission has been approved by Your Superior",
            'message' => "Dear " . $model->employee_name . ",<br/> <br/>
			Your permission request on " . $modelPermission->start_date . " for reason: \"" . $modelPermission->permission_reason . "\" has been approved by your superior. <br/> 
			Thank You.. <br/><br/>"
        ]);

        $this->newInbox([
            'recipient' => Yii::app()->user->id,
            'subject' => "Sub Ordinate Permission Approved. Permission of " . $model->employee_name . " has been approved by you",
            'message' => "Dear " . Yii::app()->user->name . ",<br/> <br/>
			Permission request of your subordinate, " . $model->employee_name . " on " . $modelPermission->start_date . " for reason: \"" . $modelPermission->permission_reason .
                "\" has been approved by you. <br/><br/>You received this notification is for security reason to
                avoid possibility approval by other people. If this happen, report to HR department and change your password immediately...<br/>
                Thank You.. <br/><br/>"
        ]);

        $modelN = new sNotification;
        $modelN->group_id = 1;
        $modelN->link = 'm1/gPermission/view/id/' . $model->id;
        $modelN->content = 'Permission Approved by Superior. Permission of <read>' . $model->employee_name . '</read> 
        on ' . $modelPermission->start_date . ' has been approved by: ' . sUser::model()->currentPerson()->employee_name;
        $modelN->photo_path = $model->photoPath;
        $modelN->save(false);


    }

    public function actionPermissionSuperiorRejected($id, $pid)
    {
        $this->loadId();
        $model = $this->loadSubordinateId($pid);

        gPermission::model()->updateByPk((int)$id, [
            'superior_approved_id' => 3, //Rejected
            'approved_id' => 3, //Rejected
            'updated_date' => time(),
            'updated_by' => Yii::app()->user->id
        ]);

        $modelPermission = gPermission::model()->findByPk((int)$id);

        $this->newInbox([
            'recipient' => $model->userid,
            'subject' => "Superior Permission Rejected. Your Permission has been rejected by Your Superior",
            'message' => "Dear " . $model->employee_name . ",<br/> <br/>
			Your permission request  on " . $modelPermission->start_date . " for reason: \"" . $modelPermission->permission_reason . "\" has been rejected by your superior. <br/> 
			Thank You.. <br/><br/>"
        ]);

        $this->newInbox([
            'recipient' => Yii::app()->user->id,
            'subject' => "Sub Ordinate Permission Rejected. Permission of " . $model->employee_name . " has been rejected by you",
            'message' => "Dear " . Yii::app()->user->name . ",<br/> <br/>
			Permission request of your subordinate, " . $model->employee_name . " on " . $modelPermission->start_date . " for reason: \"" . $modelPermission->permission_reason .
                "\" has been approved by you. <br/><br/>You received this notification is for security reason to
                avoid possibility approval by other people. If this happen, report to HR department and change your password immediately...<br/>
                Thank You.. <br/><br/>"
        ]);

        $modelN = new sNotification;
        $modelN->group_id = 1;
        $modelN->link = 'm1/gPermission/view/id/' . $model->id;
        $modelN->content = 'Permission Rejected by Superior. Permission of <read>' . $model->employee_name . '</read> 
        on ' . $modelPermission->start_date . ' has been rejected by: ' . sUser::model()->currentPerson()->employee_name;
        $modelN->photo_path = $model->photoPath;
        $modelN->save(false);

    }

    public function actionAttendanceSuperiorApproved($id, $pid)
    {
        $this->loadId();
        $model = $this->loadSubordinateId($pid);

        gAttendance::model()->updateByPk((int)$id, [
            'superior_approved_id' => 2, //Approved
        ]);

        $modelAttendance = gAttendance::model()->findByPk((int)$id);

        $this->newInbox([
            'recipient' => $model->userid,
            'subject' => "Superior Attendance Approved. Your Change Shift has been approved by Your Superior",
            'message' => "Dear " . $model->employee_name . ",<br/> <br/>
			Your request to change shift on " . $modelAttendance->cdate . " for: \"" . $modelAttendance->remark . "\" has been approved by your superior. <br/> 
			Thank You.. <br/><br/>"
        ]);

        $this->newInbox([
            'recipient' => Yii::app()->user->id,
            'subject' => "Sub Ordinate Change Shift Approved. Shift Changed of " . $model->employee_name . " has been approved by you",
            'message' => "Dear " . Yii::app()->user->name . ",<br/> <br/>
			Change Shift request of your subordinate, " . $model->employee_name . " on " . $modelAttendance->cdate . " for: \"" . $modelAttendance->remark . "\" has been approved by you. 
			<br/><br/>You received this notification is for security reason to 
			avoid possibility approval by other people. If this happen, report to HR department and change your password immediately...<br/> 
			Thank You.. <br/><br/>"
        ]);

        $modelN = new sNotification;
        $modelN->group_id = 1;
        $modelN->link = 'm1/gAttendance/view/id/' . $model->id;
        $modelN->content = 'Change Attendance Approved by Superior. Change Schedule Request of <read>' . $model->employee_name . '</read> 
        on ' . $modelAttendance->cdate . ' has been approved by: ' . sUser::model()->currentPerson()->employee_name;
        $modelN->photo_path = $model->photoPath;
        $modelN->save(false);

    }

    public function actionAttendanceSuperiorRejected($id, $pid)
    {
        $this->loadId();
        $model = $this->loadSubordinateId($pid);

        gAttendance::model()->updateByPk((int)$id, [
            'superior_approved_id' => 3, //Rejected
            'approved_id' => 3, //Rejected
        ]);

        $modelAttendance = gAttendance::model()->findByPk((int)$id);

        $this->newInbox([
            'recipient' => $model->userid,
            'subject' => "Superior Attendance Rejected. Your Change Shift has been rejected by Your Superior",
            'message' => "Dear " . $model->employee_name . ",<br/> <br/>
			Your request to change shift  on " . $modelAttendance->cdate . " for: \"" . $modelAttendance->remark . "\" has been rejected by your superior. <br/> 
			Thank You.. <br/><br/>"
        ]);

        $this->newInbox([
            'recipient' => Yii::app()->user->id,
            'subject' => "Sub Ordinate Change Shift Rejected. Shift Changed of " . $model->employee_name . " has been rejected by you",
            'message' => "Dear " . Yii::app()->user->name . ",<br/> <br/>
			Change Shift request of your subordinate, " . $model->employee_name . "  on " . $modelAttendance->cdate . " for: \"" . $modelAttendance->remark .
                "\" has been rejected by you. <br/><br/>You received this notification is for security reason to
                avoid possibility approval by other people. If this happen, report to HR department and change your password immediately...<br/>
                Thank You.. <br/><br/>"
        ]);

        $modelN = new sNotification;
        $modelN->group_id = 1;
        $modelN->link = 'm1/gAttendance/view/id/' . $model->id;
        $modelN->content = 'Change Attendance Rejected by Superior. Change Schedule Request of <read>' . $model->employee_name . '</read> 
        on ' . $modelAttendance->cdate . ' has been rejected by: ' . sUser::model()->currentPerson()->employee_name;
        $modelN->photo_path = $model->photoPath;
        $modelN->save(false);

    }

    public function actionPermission($id = 1)
    {
        $model = $this->loadId();
        $month = 0;
        $year = 0;

        $this->render('permission', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionMedical($id = 1)
    {
        $model = $this->loadId();
        $month = 0;
        $year = 0;

        $this->render('medical', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionExpense($id = 1)
    {
        $model = $this->loadId();
        $month = 0;
        $year = 0;

        $this->render('expense', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionViewVerified($id,$month = 0)
    {
        $model = $this->loadId();
        $month = 0;
        $year = 0;

        $this->render('viewVerifiedEss', [
            'model' => $model,
            'modelExpense' => $this->loadModelExpense($id),
            'modelDetail'=>$this->newDetail($id),
            'month'=>$month,
            'year'=>$year,
        ]);
    }

    public function newDetail($id)
    {
        $model = new gExpenseDetail;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gExpenseDetail'])) {
            $model->attributes = $_POST['gExpenseDetail'];
            $model->parent_id = (int)$id;

            if ($model->save()) {

                /*$this->newInbox([
                    'recipient' => $model->parent->userid,
                    'subject' => "New Career Added. You have new career added by HR Admin",
                    'message' => "Dear " . $model->parent->employee_name . ",<br/><br/> 
                    HR Admin has just added new Career on " . $model->start_date . "  as " . $model->job_title . " at " . $model->company->name . " 
                    " . $model->department->name . ", and the level is " . $model->level->name . " <br/> 
                    Thank You.. <br/><br/>"
                ]);*/

                //EQuickDlgs::checkDialogJsScript();

                $this->redirect(['viewVerified', 'id' => $id]);
            }

        }

        return $model;
    }

    public function actionLoan($id = 1)
    {
        $model = $this->loadId();
        $month = 0;
        $year = 0;

        $this->render('loan', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionAttendance($id = 1, $month = 0)
    {
        $model = $this->loadId();
        $year = 0;

        $this->render('attendance', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionTalent($id = 1, $year = 0)
    {
        $modelId = $this->loadId();
        $month = 0;

        $modelTargetSetting = $this->newTargetSetting($modelId);
        $modelCoreCompetency = $this->newCoreCompetency($modelId);
        $modelLeadershipCompetency = $this->newLeadershipCompetency($modelId);

        if ($year == 0)
            $year = date('Y');

        $this->render('talent', [
            'model' => $modelId,
            'month' => $month,
            'year' => $year,
            'modelTargetSetting' => $modelTargetSetting,
            'modelCoreCompetency' => $modelCoreCompetency,
            'modelLeadershipCompetency' => $modelLeadershipCompetency,
        ]);
    }

    public function newTargetSetting($modelId)
    {
        $model = new gTalentTargetSetting;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $year = date('Y');

        if (isset($_POST['gTalentTargetSetting'])) {
            $model->attributes = $_POST['gTalentTargetSetting'];
            $model->year = $year;
            $model->parent_id = $modelId->id;
            $model->validate_id = 1; //must requested
            if ($model->save())
                $this->redirect(['gEss/talent', 'year' => $year]);
        }

        return $model;
    }

    public function newCoreCompetency($modelId)
    {
        $model = new gTalentCoreCompetency;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $year = date('Y');

        if (isset($_POST['gTalentCoreCompetency'])) {
            $model->attributes = $_POST['gTalentCoreCompetency'];
            $model->year = $year;
            $model->parent_id = $modelId->id;
            $model->validate_id = 1; //must requested
            if ($model->save())
                $this->redirect(['gEss/talent', 'year' => $year]);
        }

        return $model;
    }

    public function newLeadershipCompetency($modelId)
    {
        $model = new gTalentLeadershipCompetency;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $year = date('Y');

        if (isset($_POST['gTalentLeadershipCompetency'])) {
            $model->attributes = $_POST['gTalentLeadershipCompetency'];
            $model->year = $year;
            $model->parent_id = $modelId->id;
            $model->validate_id = 1; //must requested
            if ($model->save())
                $this->redirect(['gEss/talent', 'year' => $year]);
        }

        return $model;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionPerson($id = 1)
    {
        $model = $this->loadId();
        $month = 0;
        $year = 0;
        $modelOther = $this->newOther($model->id);

        $this->render('person', [
            'model' => $model,
            'modelOther' => $modelOther,
            'month' => $month,
            'year' => $year,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newOther($id)
    {
        $model = new gPersonOther;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonOther'])) {
            $model->attributes = $_POST['gPersonOther'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id]);
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateLeave()
    {
        $model = new gLeave;
        $model->setScenario('createess');
        $month = 0;
        $year = 0;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLeave'])) {
            $model->attributes = $_POST['gLeave'];
            $model->parent_id = gPerson::model()->find('userid = ' . Yii::app()->user->id)->id; //default PETER
            $model->input_date = date('d-m-Y');
            $model->approved_id = 1; ///request
            $model->activation_code = peterFunc::rand_string(50);
            $model->activation_expire = strtotime($model->end_date);

            $criteria = new CDbCriteria;
            $criteria->compare('parent_id', $model->parent_id);
            $modelCount = gLeave::model()->count($criteria);

            if ($model->save()) {
                if ($modelCount == 0)
                    $this->autoGeneratedLeave($model->parent_id);

                $this->newInbox([
                    'sender' => 1, //must admin to avoid user to approve him/her self on sent Items box
                    'recipient' => $model->person->mSuperiorUserId(),
                    'subject' => "Leave Requested. " . $model->person->employee_name . " apply Leave ",
                    'message' =>
                        "Dear " . $model->person->mSuperior() . ",<br/> <br/>
						" . $model->person->employee_name . " has apply Leave on " . $model->start_date . " and will end on  " . $model->end_date . "
						for " . $model->number_of_day . " day(s) and the reason are: \"" . $model->leave_reason . "\".
						and now waiting your approval. <br/> 
                        FYI, " . $model->person->employee_name . " currently have: " . $model->person->leaveBalance->balance . " day(s) leave balance.<br/>
                        and last leave has happened on " . $model->person->leaveBalance->start_date . ".<br/><br/>

						For standard approval mechanism you can approve via application and for instant approval/rejection you can click this link: <br/><br/>"
                        . "<a href='"
                        . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/leave/code/" . $model->activation_code
                        . "'>Instant Approve</a><br/><br/>"
                        . "<a href='"
                        . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/leave/code/" . $model->activation_code . "/decision/3"
                        . "'>Instant Reject</a><br/>" .
                        "<br/><br/>Thank You.. <br/><br/>",
                ]);

                if ( ($model->person->mGolonganId() <= 6 && $model->person->mSuperiorGolonganId() <= 9) 
                    || $model->person->mGolonganId() >= 10) {
                    $this->newInbox([
                        'sender' => 1, //must admin to avoid user to approve him/her self on sent Items box
                        'recipient' => $model->person->mDoubleSuperiorUserId(),
                        'subject' => "Leave Requested. " . $model->person->employee_name . " apply Leave ",
                        'message' => "Dear " . $model->person->mDoubleSuperior() . ",<br/> <br/>
    						" . $model->person->employee_name . " has apply Leave on " . $model->start_date . " and will end on  " . $model->end_date . "
    						for " . $model->number_of_day . " day(s) and the reason are: \"" . $model->leave_reason . "\".
                            and now waiting your approval. <br/> 
                            FYI, " . $model->person->employee_name . " currently have: " . $model->person->leaveBalance->balance . " day(s) leave balance.<br/>
                            and last leave has happened on " . $model->person->leaveBalance->start_date . ".<br/><br/>
    
    						For standard approval mechanism you can approve via application and for instant approval you can click this link: <br/><br/>"
                            . "<a href='"
                            . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/leave/code/" . $model->activation_code
                            . "'>Instant Approve</a><br/><br/>"
                            . "<a href='"
                            . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/leave/code/" . $model->activation_code . "/decision/3"
                            . "'>Instant Rejected</a><br/>" .
                            "<br/><br/>Thank You.. <br/><br/>",
                    ]);
                }

                $this->redirect(['/m1/gEss/leave']);
            }
        }

        $this->render('createLeave', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateExtendedLeave()
    {
        $model = new gLeave;
        $modG = $this->loadModel();
        $month = 0;
        $year = 0;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLeave'])) {
            $model->attributes = $_POST['gLeave'];
            $model->parent_id = sUser::model()->currentPersonId(); //default PETER
            $model->input_date = date('d-m-Y');

            $_md = date('d-m-Y', strtotime(date('d-m', strtotime($modG->companyfirst->start_date)) . "-" . date('Y') . " +1 day"));
            $model->start_date = $_md;
            $model->end_date = $_md;

            $model->approved_id = 5; ///Extended Leave Request
            $model->superior_approved_id = 5; ///Extended Leave Request
            if ($model->save())
                $this->redirect(['leave']);
        }

        $model->input_date = date('d-m-Y');
        $_md = date('d-m-Y', strtotime(date('d-m', strtotime($modG->companyfirst->start_date)) . "-" . date('Y') . " +1 day"));
        $model->start_date = $_md;
        //$_mn = date("d-m-Y", strtotime(date('d-m', strtotime($modG->companyfirst->start_date)) . "-" . date('Y') . "+6 month"));
        //$model->end_date = $_mn;
        $model->end_date = $_md;
        $model->number_of_day = $modG->leaveBalance->balance;
        $this->render('createExtendedLeave', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionCreateSwitchoverLeave()
    {
        $model = new gLeave;
        $modG = $this->loadModel();
        $month = 0;
        $year = 0;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLeave'])) {
            $model->attributes = $_POST['gLeave'];
            $model->parent_id = sUser::model()->currentPersonId(); //default PETER
            $model->input_date = date('d-m-Y');

            $_md = date('d-m-Y', strtotime(date('d-m', strtotime($modG->companyfirst->start_date)) . "-" . date('Y') . " +1 day"));

            $model->approved_id = 6; ///Switchover Leave Request
            $model->superior_approved_id = 6; ///Switchover Leave Request
            if ($model->save())
                $this->redirect(['leave']);
        }

        $model->input_date = date('d-m-Y');
        $this->render('createSwitchoverLeave', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreatePermission($id = 0)
    {
        $model = new gPermission;
        $month = 0;
        $year = 0;

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());

        $modelAttendance = gAttendance::model()->find($criteria);
        if ($modelAttendance != null && !isset($_POST['gPermission'])) {
            if ($modelAttendance->lateInStatus == "Late In") {
                $model->start_date = $modelAttendance->cdate . ' ' . date('H:i', strtotime($modelAttendance->realpattern->in));
                $model->end_date = $modelAttendance->cdate . ' ' . date('H:i', strtotime($modelAttendance->in));
                //$model->permission_type_id = 11;
            } elseif ($modelAttendance->earlyOutStatus == "Early Out") {
                $model->start_date = $modelAttendance->cdate . ' ' . date('H:i', strtotime($modelAttendance->out));
                $model->end_date = $modelAttendance->cdate . ' ' . date('H:i', strtotime($modelAttendance->realpattern->out));
                //$model->permission_type_id = 12;
            } elseif ($modelAttendance->actualIn == "??:??" and $modelAttendance->actualOut != "??:??" AND
                $modelAttendance->getSyncLeave() == null AND $modelAttendance->getSyncPermission() == null
            ) {
                $model->start_date = $modelAttendance->cdate . ' ' . date('H:i', strtotime($modelAttendance->realpattern->in));
                $model->end_date = $modelAttendance->cdate . ' ' . date('H:i', strtotime($modelAttendance->realpattern->out));
                //$model->permission_type_id = 13;
            } elseif ($modelAttendance->actualIn != "??:??" and $modelAttendance->actualOut == "??:??" AND
                $modelAttendance->getSyncLeave() == null AND $modelAttendance->getSyncPermission() == null
            ) {
                $model->start_date = $modelAttendance->cdate . ' ' . date('H:i', strtotime($modelAttendance->realpattern->in));
                $model->end_date = $modelAttendance->cdate . ' ' . date('H:i', strtotime($modelAttendance->realpattern->out));
                //$model->permission_type_id = 14;
            } elseif ($modelAttendance->actualIn == "??:??" and $modelAttendance->actualOut == "??:??" AND
                $modelAttendance->getSyncLeave() == null AND $modelAttendance->getSyncPermission() == null
            ) {
                $model->start_date = $modelAttendance->cdate . ' ' . date('H:i', strtotime($modelAttendance->realpattern->in));
                $model->end_date = $modelAttendance->cdate . ' ' . date('H:i', strtotime($modelAttendance->realpattern->out));
                //$model->permission_type_id = 10;
            }
        }
        //
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPermission'])) {
            $model->attributes = $_POST['gPermission'];
            $model->parent_id = sUser::model()->currentPersonId(); //default PETER
            $model->approved_id = 1; ///request
            $model->input_date = date('d-m-Y');
            $model->activation_code = peterFunc::rand_string(50);
            $model->activation_expire = strtotime("+1 weeks", strtotime($model->start_date));
            if ($model->save()) {

                $this->newInbox([
                    'sender' => 1, //must admin to avoid user to approve him/her self on sent Items box
                    'recipient' => $model->person->mSuperiorUserId(),
                    'subject' => "Permission Requested. " . $model->person->employee_name . " apply Permission ",
                    'message' =>
                        "Dear " . $model->person->mSuperior() . ",<br/>
					" . $model->person->employee_name . " has apply Permission on " . $model->start_date . " and will end on  " . $model->end_date . "
					and the reason are: \"" . $model->permission_reason . "\".
					and now waiting your approval. <br/>
						For standard approval mechanism you can approve #1. via application and #2. for instant approval/rejection you can click this link: <br/><br/>"
                        . "<a href='"
                        . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/permission/code/" . $model->activation_code
                        . "'>Instant Approve</a><br/><br/>"
                        . "<a href='"
                        . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/permission/code/" . $model->activation_code . "/decision/3"
                        . "'>Instant Reject</a><br/>" .
                        "<br/><br/>Thank You.. <br/><br/>",
                ]);

                if ( ($model->person->mGolonganId() <= 6 && $model->person->mSuperiorGolonganId() <= 9) 
                    || $model->person->mGolonganId() >= 10) {
                    $this->newInbox([
                        'sender' => 1, //must admin to avoid user to approve him/her self on sent Items box
                        'recipient' => $model->person->mDoubleSuperiorUserId(),
                        'subject' => "Permission Requested. " . $model->person->employee_name . " apply Permission ",
                        'message' =>
                            "Dear " . $model->person->mDoubleSuperior() . ",<br/>
                        " . $model->person->employee_name . " has apply Permission on " . $model->start_date . " and will end on  " . $model->end_date . "
                        and the reason are: \"" . $model->permission_reason . "\".
                        and now waiting your approval. <br/>
                            For standard approval mechanism you can approve #1. via application and #2. for instant approval/rejection you can click this link: <br/><br/>"
                            . "<a href='"
                            . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/permission/code/" . $model->activation_code
                            . "'>Instant Approve</a><br/><br/>"
                            . "<a href='"
                            . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/permission/code/" . $model->activation_code . "/decision/3"
                            . "'>Instant Reject</a><br/>" .
                            "<br/><br/>Thank You.. <br/><br/>",
                    ]);
                }

                $this->redirect(['permission']);
            }
        }

        $this->render('createPermission', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionCreateMedical($id = 0)
    {
        $model = new gMedical;
        $month = 0;
        $year = 0;

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());

        if (isset($_POST['gMedical'])) {
            $model->attributes = $_POST['gMedical'];
            $model->parent_id = sUser::model()->currentPersonId(); //default PETER
            if ($model->medicine == 0)
                ;
            $model->medicine = $model->original_amount;

            $model->approved_id = 1; ///request
            $model->input_date = date('d-m-Y');
            if ($model->save()) {

                $this->newInbox([
                    'recipient' => $model->person->mSuperiorUserId(),
                    'subject' => "Medical Requested. " . $model->person->employee_name . " apply Medical ",
                    'message' =>
                        "Dear " . $model->person->mSuperior() . ",<br/> <br/>
                    " . $model->person->employee_name . " has apply Medical on " . $model->input_date . "
                    and the sympthom are: \"" . $model->sympthom . "\".
                    and now waiting your approval. <br/> <br/>",
                ]);


                $this->redirect(['medical']);
            }
        }

        $this->render('createMedical', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionCreateExpense($id = 0)
    {
        $model = new gExpense;
        $month = 0;
        $year = 0;

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());

        if (isset($_POST['gExpense'])) {
            $model->attributes = $_POST['gExpense'];
            $model->parent_id = sUser::model()->currentPersonId(); //default PETER

            $model->approved_id = 1; ///request
            $model->input_date = date('d-m-Y');
            $transportation_type = $model->transportation_type;
            $model->transportation_type = ""; //null for passing validation
            $model->activation_code = peterFunc::rand_string(50);
            $model->activation_expire = strtotime("+1 weeks", strtotime($model->start_date));
            if ($model->save()) {
                if (is_array($transportation_type)) {
                    foreach ($transportation_type as $mod) {
                        $modelDetail = new gExpenseDetail;
                        $modelDetail->parent_id = $model->id;
                        $modelDetail->expense_id = $mod;
                        $modelDetail->save(false);
                    }
                }

                $modelPerson = $this->loadModel($model->parent_id);

                $modelExpenseN = new gExpenseDetail;
                $modelExpenseN->parent_id = $model->id;
                $modelExpenseN->expense_id = gParamExpenseDetail::model()->getExpenseLevel(13,$modelPerson->mLevelParentId())->id;
                $modelExpenseN->amount = gParamExpenseDetail::model()->getExpenseLevel(13,$modelPerson->mLevelParentId())->amount * $model->number_of_day;
                $modelExpenseN->payment_source_id = 2;
                $modelExpenseN->save(false);

                //Uang Saku
                $modelExpenseN = new gExpenseDetail;
                $modelExpenseN->parent_id = $model->id;
                $modelExpenseN->expense_id = gParamExpenseDetail::model()->getExpenseLevel(16,$modelPerson->mLevelParentId())->id;
                $modelExpenseN->amount = gParamExpenseDetail::model()->getExpenseLevel(16,$modelPerson->mLevelParentId())->amount * $model->number_of_day;
                $modelExpenseN->payment_source_id = 2;
                $modelExpenseN->save(false);


                $type = ($model->expense_type_id == 2) ? "Travel" : "Return To Homebase";
                $this->newInbox([
                    'sender' => 1, //must admin to avoid user to approve him/her self on sent Items box
                    'recipient' => $model->person->mSuperiorUserId(),
                    'subject' => $type . " Requested. " . $model->person->employee_name . " apply ".$type,
                    'message' =>
                        "Dear " . $model->person->mSuperior() . ",<br/> <br/>
                    " . $model->person->employee_name . " has apply ".$type." on " . $model->start_date . " until " . $model->end_date . "
                    destination to ".$model->destination." and the purpose are: \"" . $model->purpose . "\".
                    and now waiting your approval. <br/>
                    For standard approval mechanism you can approve #1. via application and #2. for instant approval/rejection you can click this link: <br/><br/>"
                    . "<a href='"
                    . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/expense/code/" . $model->activation_code
                    . "'>Instant Approve</a><br/><br/>"
                    . "<a href='"
                    . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/expense/code/" . $model->activation_code . "/decision/3"
                    . "'>Instant Reject</a><br/>" .
                    "<br/><br/>Thank You.. <br/><br/>",
                ]);

                if ( ($model->person->mGolonganId() <= 6 && $model->person->mSuperiorGolonganId() <= 9) 
                    || $model->person->mGolonganId() >= 10) {

                    $type = ($model->expense_type_id == 2) ? "Business Travel" : "Return To Homebase";
                    $this->newInbox([
                        'sender' => 1, //must admin to avoid user to approve him/her self on sent Items box
                        'recipient' => $model->person->mDoubleSuperiorUserId(),
                        'subject' => $type. " Requested. " . $model->person->employee_name . " apply ".$type,
                        'message' =>
                            "Dear " . $model->person->mDoubleSuperior() . ",<br/>
                        " . $model->person->employee_name . " has apply ".$type." on " . $model->start_date . " until " . $model->end_date . "
                        destination to ".$model->destination." and the purpose are: \"" . $model->purpose . "\".
                        and now waiting your approval. <br/>
                            For standard approval mechanism you can approve #1. via application and #2. for instant approval/rejection you can click this link: <br/><br/>"
                            . "<a href='"
                            . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/expense/code/" . $model->activation_code
                            . "'>Instant Approve</a><br/><br/>"
                            . "<a href='"
                            . Yii::app()->request->HostInfo . "/index.php/site/approvedByMe/mod/expense/code/" . $model->activation_code . "/decision/3"
                            . "'>Instant Reject</a><br/>" .
                            "<br/><br/>Thank You.. <br/><br/>",
                    ]);
                }

                $this->redirect(['expense']);
            }
        } else {
            
            $model->cost_center_id = sUser::model()->myGroup;

        }

        $this->render('createExpense', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionCreateLoan($id = 0)
    {
        $model = new gLoan;
        $month = 0;
        $year = 0;

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());

        if (isset($_POST['gLoan'])) {
            $model->attributes = $_POST['gLoan'];
            $model->parent_id = sUser::model()->currentPersonId(); //default PETER

            $model->approved_id = 1; ///request
            $model->input_date = date('d-m-Y');
            if ($model->save()) {

                $this->newInbox([
                    'recipient' => $model->person->mSuperiorUserId(),
                    'subject' => "Loan Requested. " . $model->person->employee_name . " apply Loan ",
                    'message' =>
                        "Dear " . $model->person->mSuperior() . ",<br/> <br/>
                    " . $model->person->employee_name . " has apply Loan on " . $model->input_date . "
                    and the purpose are: \"" . $model->purpose . "\".
                    and now waiting your approval. <br/> <br/>",
                ]);

                $this->redirect(['loan']);
            }
        }

        $this->render('createLoan', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdatePerson($month = 0)
    {
        //$this->layout='//layouts/column2';

        $year = 0;
        $model = $this->loadModel();
        $model->setScenario('ess');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPerson'])) {
            $model->attributes = $_POST['gPerson'];
            if ($model->save())
                $this->redirect(['/m1/gEss']);
        }

        $this->render('updatePerson', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdatePermission($id, $month = 0)
    {
        $model = $this->loadModel();
        $year = 0;
        $modelPermission = $this->loadModelPermission($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPermission'])) {
            $modelPermission->attributes = $_POST['gPermission'];
            if ($modelPermission->save())
                $this->redirect(['/m1/gEss/permission']);
        }

        $this->render('updatePermission', [
            'model' => $model,
            'modelPermission' => $modelPermission,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionUpdateMedical($id, $month = 0)
    {
        $model = $this->loadModel();
        $year = 0;
        $modelMedical = $this->loadModelMedical($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gMedical'])) {
            $modelMedical->attributes = $_POST['gMedical'];
            if ($modelMedical->save())
                $this->redirect(['/m1/gEss/medical']);
        }

        $this->render('updateMedical', [
            'model' => $model,
            'modelMedical' => $modelMedical,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionUpdateLeave($id, $month = 0)
    {
        $model = $this->loadModel();
        $year = 0;
        $modelLeave = $this->loadModelLeave($id);

        if (strtotime($modelLeave->start_date) <= time())
            $this->redirect(['/m1/gEss/leave']);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLeave'])) {
            $modelLeave->attributes = $_POST['gLeave'];
            if ($modelLeave->save())
                $this->redirect(['/m1/gEss/leave']);
        }

        $this->render('updateLeave', [
            'model' => $model,
            'modelLeave' => $modelLeave,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionChangeAttendance($id, $month = 0)
    {
        $model = $this->loadModel();
        $year = 0;
        $modelAttendance = $this->loadModelAttendance($id);
        $modelAttendance->setScenario('changeshift');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gAttendance']['remark'])) {
            $modelAttendance->attributes = $_POST['gAttendance'];
            $modelAttendance->superior_approved_id = 1; //change to Request
            $modelAttendance->approved_id = 1; //change to Request
            if ($modelAttendance->save()) {

                $modelNotif = new sNotification;
                $modelNotif->group_id = 1;
                $modelNotif->link = 'm1/gAttendance/view/id/' . $model->id;
                $modelNotif->content = 'Attendance. New Schedule Change Request created by <read>' . $model->employee_name . '</read> on '
                    . $modelAttendance->cdate . ' for: "' . $modelAttendance->remark . '"';
                $modelNotif->photo_path = $model->photoPath;
                $modelNotif->save(false);

                $this->newInbox([
                    'sender' => 1, //must admin to avoid user to approve him/her self on sent Items box
                    'recipient' => $modelAttendance->person->mSuperiorUserId(),
                    'subject' => "Change Attendance Schedule Requested. " . $modelAttendance->person->employee_name . " apply Change Attendance Schedule ",
                    'message' =>
                        "Dear " . $modelAttendance->person->mSuperior() . ",<br/>
                    " . $modelAttendance->person->employee_name . " has apply Change Attendance Schedule on " . $modelAttendance->cdate . " and the reason are: \"" . $modelAttendance->remark . "\" ",
                ]);

                if ( ($modelAttendance->person->mGolonganId() <= 6 && $modelAttendance->person->mSuperiorGolonganId() <= 9) 
                    || $modelAttendance->person->mGolonganId() >= 10) {
                    $this->newInbox([
                        'sender' => 1, //must admin to avoid user to approve him/her self on sent Items box
                        'recipient' => $modelAttendance->person->mDoubleSuperiorUserId(),
                        'subject' => "Change Attendance Schedule Requested. " . $modelAttendance->person->employee_name . " apply Change Attendance Schedule ",
                        'message' =>
                            "Dear " . $modelAttendance->person->mDoubleSuperior() . ",<br/>
                        " . $modelAttendance->person->employee_name . " has apply Change Attendance Schedule on " . $modelAttendance->cdate . " and the reason are: \"" . $modelAttendance->remark . "\" ",
                    ]);
                }


                Yii::app()->user->setFlash('success', '<strong>Success!</strong> Change Schedule has been set succesfully...');
                //$this->redirect(array('/m1/gEss/attendance'));
            }
        }

        $this->render('changeAttendance', [
            'model' => $model,
            'modelAttendance' => $modelAttendance,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionChangeAttendanceDelete($id, $month = 0)
    {
        $model = $this->loadModel();
        $year = 0;
        $modelAttendance = $this->loadModelAttendance($id);

        $modelAttendance->approved_id = 0;
        $modelAttendance->superior_approved_id = 0;
        $modelAttendance->changepattern_id = 0;
        $modelAttendance->remark = null;
        $modelAttendance->save(false);

        return true;
    }

    public function actionUpdateExpenseDetail($id)
    {
        $this->loadModel();

        $model = $this->loadModelExpenseDetail($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gExpenseDetail'])) {
            $model->attributes = $_POST['gExpenseDetail'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('/gExpense/_formExpenseDetail', ['model' => $model]);
    }

    public function actionDeleteLeave($id)
    {

        $this->loadModel();

        $model = $this->loadModelLeave($id);


        if (strtotime($model->start_date) < time())
            $this->redirect(['/m1/gEss/leave']);

        $model->delete();

        $this->redirect(['/m1/gEss/leave']);
    }

    public function actionDeleteExpenseDetail($id)
    {

        $this->loadModel();

        $model = $this->loadModelExpenseDetail($id);

        $model->delete();

        $this->redirect(['/m1/gEss/expense']);
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel()
    {
        $model = gPerson::model()->find('userid = ' . Yii::app()->user->id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelSubOrdinate($id)
    {
        $model = gPerson::model()->findByPk((int)$id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModelPermission($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('approved_id', 1);

        $model = gPermission::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelMedical($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('approved_id', 1);

        $model = gMedical::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelLeave($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', (int)$id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        //$criteria->addInCondition('approved_id',array(1,7,8)); //yang bisa di-delete/update hanya request, extended dan cancel
        $criteria1 = new CDbCriteria;
        $criteria1->condition = 'balance is null'; //approved_id 1,7,8 when balance is null
        $criteria->mergeWith($criteria1);

        $model = gLeave::model()->find($criteria);
        if ($model == null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        return $model;
    }

    public function loadModelAttendance($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        //$criteria->compare('approved_id', 1);

        $model = gAttendance::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelExpense($id)
    {
        $model = gExpense::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelExpenseDetail($id)
    {
        $model = gExpenseDetail::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }


    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'g-person-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /////////////////////////////////////////////////////
    public function actionPrintLeave($id)
    {
        $pdf = new leaveForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('approved_id', 1);

        $model = gLeave::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionPrintCancellationLeave($id)
    {
        $pdf = new leaveCancellationForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('approved_id', 6);

        $model = gLeave::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionPrintExtendedLeave($id)
    {
        $pdf = new leaveExtendedForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        //$criteria->compare('approved_id', 6);

        $model = gLeave::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionPrintSwitchoverLeave($id)
    {
        $pdf = new leaveSwitchoverForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        //$criteria->compare('approved_id', 6);

        $model = gLeave::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }


    public function actionSummaryLeave($pid)
    {
        $pdf = new leaveSummary('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->with = ['leave'];
        $criteria->condition = 'leave.approved_id IN (2,7,9)';
        $criteria->compare('leave.parent_id', sUser::model()->currentPersonId());
        $criteria->compare('t.id', (int)$pid);
        $models = gPerson::model()->find($criteria);
        if ($models === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($models);

        $pdf->Output();
    }

    public function actionPrintPermission($id)
    {
        $pdf = new permissionForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('approved_id', 1);

        $model = gPermission::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionPrintMedical($id)
    {
        $this->loadId();

        $pdf = new medicalForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('approved_id', 1);

        $model = gMedical::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionPrintExpense($id)
    {
        $this->loadId();


        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('approved_id', 1);

        $model = gExpense::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        if ($model->expense_type_id == 2 ) {
            $pdf = new expenseForm('P', 'mm', 'A4');
        } else
            $pdf = new expenseFormHomebase('P', 'mm', 'A4');

        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);


        $pdf->report($model);

        $pdf->Output();
    }

    public function actionPrintRealization($id)
    {
        $pdf = new expenseRealization('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('approved_id', 2);

        $model = gExpense::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionOtherNamecard($pid)
    {
        $pdf = new otherNamecard('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('t.id', sUser::model()->currentPersonId());
        $criteria->compare('t.id', (int)$pid);
        $models = gPerson::model()->find($criteria);
        if ($models === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($models);

        $pdf->Output();
    }


    public function actionSummaryAttendance($id, $month)
    {
        $pdf = new attendanceDetail('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('parent_id', $id);
        $criteria->addBetweenCondition('cdate', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));
        //$criteria->compare('cdate',$this->cdate,true);
        //$criteria->compare('realpattern_id',$this->realpattern_id);
        //$criteria->compare('daystatus1_id',$this->daystatus1_id);
        //$criteria->compare('in',$this->in,true);
        //$criteria->compare('out',$this->out,true);
        $criteria->order = 'cdate';
        $criteria->with = 'realpattern';
        $criteria->select = 'CASE WHEN TIME(realpattern.in) < TIME(t.in) THEN "Late In" ELSE "" END as lateIn,
		CASE WHEN TIME(realpattern.out) > TIME(t.out) THEN "Early Out" ELSE "" END as earlyOut, *';

        $models = gAttendance::model()->findAll($criteria);
        if ($models == null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($models);

        $pdf->Output();
    }

    public function actionInfoMedical($id)
    {
        $pdf = new medicalInfo('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());

        $model = gMedical::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionSummaryMedical($pid)
    {
        $pdf = new medicalSummary('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->with = ['medical'];
        $criteria->compare('medical.parent_id', sUser::model()->currentPersonId());
        $criteria->compare('t.id', (int)$pid);
        $models = gPerson::model()->find($criteria);
        if ($models === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($models);

        $pdf->Output();
    }

    public function actionChangeAttendancePrint($id)
    {
        $pdf = new attendanceForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('approved_id', 1);

        $model = gAttendance::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionCalendarEvents()
    {
        $criteria = new CDbCriteria;
        $criteria->with = ['getparent'];
        $criteria->compare('year(schedule_date)', date("Y"));
        $criteria->together = true;
        $criteria->AddInCondition('getparent.type_id', [1, 2]);

        $models = iLearningSch::model()->findAll($criteria);

        $items = [];
        $detail = [];
        $input = ["#CC0000", "#0000CC", "#333333", "#663333", "#993333", "#CC3333", "#003366", "#663366", "#993366", "#CC3366", "#6633CC"];
        foreach ($models as $model) {
            $detail['id'] = $model->id;
            $detail['title'] = $model->getparent->learning_title . " (" . $model->partCount . ")";
            $detail['start'] = date('Y') . '-' . date('m', strtotime($model->schedule_date)) . '-' . date('d', strtotime($model->schedule_date));
            //$detail['start']= $model->schedule_date;
            $detail['color'] = $input[rand(0, 10)];
            $detail['allDay'] = true;
            //$detail['url'] = Yii::app()->createUrl('/m1/gEss/viewDetailEss', array("id" => $model->id));
            $detail['url'] = '#';
            $items[] = $detail;
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionViewDetailEss($id)
    {
        $month = 0;
        $year = 0;

        if (@$_GET['asModal'] == true) {
            $this->renderPartial('viewDetailEss', [
                'model' => $this->loadModelSchedule($id),
                'month' => $month,
                'year' => $year,
            ], false, true);
        } else {
            $this->render('viewDetailEss', [
                'model' => $this->loadModelSchedule($id),
                'month' => $month,
                'year' => $year,
            ]);
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModelSchedule($id)
    {
        $model = iLearningSch::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function actionPersonAutoComplete()
    {

        $res = [];
        if (isset($_GET['term'])) {
            if (Yii::app()->user->name != "admin") {
                $qtxt = 'SELECT DISTINCT a.employee_name FROM g_person a
			WHERE a.employee_name LIKE :name AND ' .
                    '((select c.company_id from g_person_career c WHERE a.id=c.parent_id AND c.status_id IN (' .
                    implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                    ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                    implode(",", sUser::model()->myGroupArray) . ') OR ' .
                    '(select c2.company_id from g_person_career2 c2 WHERE a.id=c2.parent_id AND c2.company_id IN (' .
                    implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                    implode(",", sUser::model()->myGroupArray) . ')) ' .
                    'ORDER BY a.employee_name LIMIT 20';
            } else {
                $qtxt = "SELECT DISTINCT a.employee_name FROM g_person a
			WHERE a.employee_name LIKE :name
			ORDER BY a.employee_name LIMIT 20";
            }
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryColumn();
            //$res =$command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionViewAnnouncement($id)
    {
        $month = 0;
        $year = 0;

        $this->render('viewAnnouncement', [
            'model' => $this->loadModelCompanyNews($id),
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function loadModelCompanyNews($id)
    {

        $criteria = new CDbCriteria;
        $criteria->order = "t.created_date DESC";
        $criteria->limit = 15;
        $criteria->compare('category_id', 8);
        $criteria->with = ['created'];
        $criteria->together = true;
        $criteria->compare('created.default_group', sUser::getMyGroup());
        $criteria->scopes = ['app_publish'];

        $model = sCompanyNews::model()->findByPk((int)$id, $criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function actionDepartmentCalendarAjax($id)
    {

        $connection = Yii::app()->db;
        $sql = '
			SELECT l.parent_id, l.start_date, l.end_date, t.id, t.employee_name, l.approved_id, s.name 
			FROM g_leave l
			INNER JOIN g_person t ON t.id = l.parent_id
			INNER JOIN s_parameter s ON s.code = l.approved_id AND s.type = "cLeaveApproved"
			WHERE l.approved_id IN (1,2) AND
			year(l.start_date) = ' . date('Y') . ' AND 

            (select s.status_id from g_person_status s WHERE l.parent_id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
		(' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
            '(select c.department_id from g_person_career c WHERE l.parent_id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) = ' . $id . ';

			
		';

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        $items = [];
        $detail = [];
        foreach ($rows as $row) {
            $detail['title'] = $row['employee_name'] . ' (' . $row['name'] . ')';
            $detail['start'] = strtotime($row['start_date']);
            $detail['end'] = strtotime($row['end_date']);
            if ($row['approved_id'] == 1) {
                $detail['color'] = '#CC0000';
            } else
                $detail['color'] = '#088A4B';

            $detail['allDay'] = true;
            $items[] = $detail;
        }

        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionPersonalCalendarAjax()
    {

        $connection = Yii::app()->db;
        $sql = '
            SELECT a.parent_id, a.cdate, a.realpattern_id, p.code, a.in, a.out, p.in as pin, p.out as pout, t.id, t.employee_name 
            FROM g_attendance a
            INNER JOIN g_person t ON t.id = a.parent_id
            INNER JOIN g_param_timeblock p ON p.id = a.realpattern_id
            WHERE 
            year(a.cdate) = ' . date('Y') . ' AND a.parent_id = ' . sUser::model()->currentPersonId() . '


            
        ';

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        $items = [];
        $detail = [];
        foreach ($rows as $row) {
            $detail['title'] = $row['code'];
            $detail['start'] = strtotime(date('d-m-Y', strtotime($row['cdate'])) . ' ' . date('H:i', strtotime($row['pin'])));
            $detail['end'] = strtotime(date('d-m-Y', strtotime($row['cdate'])) . ' ' . date('H:i', strtotime($row['pout'])));
            $detail['allDay'] = false;

            if (in_array($row['realpattern_id'], [89, 90])) {
                $detail['color'] = '#000000';
                $detail['allDay'] = true;
            } elseif (time() < strtotime($row['cdate'])) {
                $detail['color'] = '#CC0000';
            } else
                $detail['color'] = '#088A4B';

            $items[] = $detail;
        }

        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionUpdateLeaveAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gLeave'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionUpdateAttendanceAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gAttendance'); // 'User' is classname of model to be updated
        $es->update();
    }

}
