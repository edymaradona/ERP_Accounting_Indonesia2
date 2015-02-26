<?php

class GPermissionController extends Controller
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
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', [
            'model' => $this->loadModel($id),
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new gPermission;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPermission'])) {
            $model->attributes = $_POST['gPermission'];
            $model->input_date = date('d-m-Y');
            $model->approved_id = 1; ///request
            $model->activation_code = peterFunc::rand_string(50);
            $model->activation_expire = strtotime("+1 weeks", strtotime($model->start_date));
            if ($model->save())
                $this->redirect(['/m1/gPermission']);
        }

        $this->render('createWithEmp', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModelPermission($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPermission'])) {
            $model->attributes = $_POST['gPermission'];
            if ($model->save())
                //$this->redirect(array('/m1/gPermission'));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('update', ['model' => $model]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelPermission($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionOnRecent()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
        }

        $criteria->mergeWith($criteria1);

        $this->render('onRecent', [
            'model' => $model,
        ]);
    }

    public function actionOnPermission()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
        }

        $criteria->mergeWith($criteria1);

        $this->render('onPermission', [
            'model' => $model,
        ]);
    }

    public function actionOnSuperior()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
        }

        $criteria->mergeWith($criteria1);

        $this->render('onSuperior', [
            'model' => $model,
        ]);
    }

    public function actionOnApproved()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
        }

        $criteria->mergeWith($criteria1);

        $this->render('onApproved', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all models.
     */
    public function actionList()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
        }

        $criteria->mergeWith($criteria1);

        if (Yii::app()->user->name != "admin") {
            $criteria2 = new CDbCriteria;
            $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria2);
        }

        $dataProvider = new CActiveDataProvider('gPerson', [
                'criteria' => $criteria,
            ]
        );

        $this->render('list', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionApproved($id, $pid)
    {
        $model = $this->loadModelPermission($id);
        $modelPerson = gPerson::model()->findByPk($pid);


        $model->approved_id = 2;
        $model->superior_approved_id = 2;
        $model->save(false);

        if ($model->permission_type_id == 23) {
            $modelAttendance = gAttendance::model()->find('parent_id =' . $pid . ' AND cdate = "' . date('Y-m-d', strtotime($model->start_date)) . '"');
            if (isset($modelAttendance)) {
                if (!isset($modelAttendance->in) || peterFunc::isTimeMore($modelAttendance->in, $modelAttendance->realpattern->in))
                    $modelAttendance->in = date("d-m-Y", strtotime($modelAttendance->in)) . " " . date('H:i', strtotime($modelAttendance->realpattern->in));

                if (!isset($modelAttendance->out) || peterFunc::isTimeMore2($modelAttendance->realpattern->out, $modelAttendance->out, $modelAttendance->in))
                    $modelAttendance->out = date("d-m-Y", strtotime($modelAttendance->out)) . " " . date('H:i', strtotime($modelAttendance->realpattern->out));

                $modelAttendance->save(false);
            }
        } elseif ($model->permission_type_id == 12) {
            $modelAttendance = gAttendance::model()->find('t.out is null AND parent_id =' . $pid . ' AND cdate = "' . date('Y-m-d', strtotime($model->start_date)) . '"');
            if ($modelAttendance != null) {
                $modelAttendance->out = date("d-m-Y H:i", strtotime($model->start_date));
                $modelAttendance->save(false);
            }
        } elseif ($model->permission_type_id == 11) {
            $modelAttendance = gAttendance::model()->find('t.in is null AND parent_id =' . $pid . ' AND cdate = "' . date('Y-m-d', strtotime($model->start_date)) . '"');
            if ($modelAttendance != null) {
                $modelAttendance->in = date("d-m-Y H:i", strtotime($model->end_date));
                $modelAttendance->save(false);
            }
        }


        $this->newInbox([
            'recipient' => $modelPerson->userid,
            'subject' => "Permission Approved. Your Permission has been approved by HR Admin",
            'message' => "Dear " . $model->person->employee_name . ",<br/> <br/>
			Your permission request on " . $model->start_date . " for: \"" . $model->permission_reason . "\" has been approved by HR Admin. <br/> 
			Thank You.. <br/><br/>"
        ]);
    }

    /*public function actionUnblock($id, $pid)
    {

        gPermission::model()->updateByPk((int)$id, [
            'approved_id' => 1,
        ]);
    }*/

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $criteria = new CDbCriteria;

        if (Yii::app()->user->name != "admin") {
            $criteria->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
                implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                implode(",", sUser::model()->myGroupArray) . ') OR ' .
                '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
                implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                implode(",", sUser::model()->myGroupArray) . ')';
        }

        $model = gPerson::model()->findByPk((int)$id, $criteria);
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
        $model = gPermission::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'g-cuti-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPrintPermission($id)
    {
        $pdf = new permissionForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('approved_id', 1);

        $model = gPermission::model()->find($criteria);
        $modelParent = $this->loadmodel($model->parent_id);

        if ($model === null || $modelParent === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionReportByDept()
    {
        $model = new fBeginEndDate;
        $model->setScenario("report");

        if (isset($_POST['fBeginEndDate'])) {
            $model->attributes = $_POST['fBeginEndDate'];
            if ($model->validate()) {

                if ($model->report_id == 1) { //Detail
                    $pdf = new permissionSummaryByDept('L', 'mm', 'A4');
                    $pdf->AliasNbPages();
                    $pdf->AddPage();
                    $pdf->SetFont('Arial', '', 12);

                    $connection = Yii::app()->db;
                    $sql = "SELECT a.employee_name, a.company, a.department, a.level, a.join_date, a.job_title,
                    		p.permission_type_id, p.start_date, p.end_date, p.permission_reason, g.name
						FROM g_permission p  
						INNER JOIN g_param_permission g ON g.id = p.permission_type_id
						INNER JOIN g_bi_person_lite a ON p.parent_id = a.id
						WHERE a.company_id = " . $model->company_id . " AND a.employee_status NOT IN ('Resign','End of Contract','Black List','Termination')
						AND CONCAT(year(p.start_date), lpad(month(p.start_date),2,'0')) = " . $model->period . " and p.start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'
						ORDER by p.permission_type_id, a.employee_name,p.start_date";

                    $command = $connection->createCommand($sql);
                    $rows = $command->queryAll();

                    $pdf->report($rows, $model);
                } //else

                $pdf->Output();
            }
        }

        $this->render('reportByDept', ['model' => $model]);
    }

    public function actionPermissionCalendar()
    {
        $this->render('permissionCalendar', []);
    }

    public function actionPermissionCalendarAjax()
    {

        $connection = Yii::app()->db;
        $sql = '
			SELECT l.parent_id, l.start_date, l.end_date, t.id, t.employee_name, l.approved_id, s.name 
			FROM g_permission l
			INNER JOIN g_person t ON t.id = l.parent_id
			INNER JOIN s_parameter s ON s.code = l.approved_id AND s.type = "cLeaveApproved"
			WHERE l.approved_id IN (1,2) AND
			year(l.start_date) = ' . date('Y') . ' AND 

			(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ') OR ' .
            '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
            implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')
			
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
            $detail['url'] = Yii::app()->createUrl('/m1/gPermission/view', ["id" => $row['id']]);
            $items[] = $detail;
        }

        echo CJSON::encode($items);
        Yii::app()->end();
    }

}
