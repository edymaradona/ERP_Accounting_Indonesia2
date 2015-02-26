<?php

class GExpenseController extends Controller
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

    public function actionViewVerified($id, $pid)
    {

        $model = $this->loadModel($pid);
        $modelExpense = $this->loadModelExpense($id);

        $this->render('viewVerified', [
            'model' => $model,
            'modelExpense' => $modelExpense,
            'modelDetail'=>$this->newDetail($id,$pid)
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new gExpense;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gExpense'])) {
            $model->attributes = $_POST['gExpense'];
            $model->input_date = date('d-m-Y');
            $model->approved_id = 1; ///request
            $transportation_type = $model->transportation_type;
            $model->transportation_type = ""; //null for passing validation
            //$model->activation_code = peterFunc::rand_string(50);
            //$model->activation_expire = strtotime("+1 weeks", strtotime($model->start_date));
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
                //Uang Makan
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



                $this->redirect(['/m1/gExpense']);
            }
        } else {
            $model->cost_center_id = sUser::model()->myGroup;
        }

        $this->render('createWithEmp', [
            'model' => $model,
        ]);
    }

    public function newDetail($id, $pid)
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

                $this->redirect(['viewVerified', 'id' => $id, 'pid' => $pid]);
            }

        }

        return $model;
    }


    public function actionCreateDetailAjax($id, $pid)
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

                EQuickDlgs::checkDialogJsScript();

                $this->redirect(['viewVerified', 'id' => $id, 'pid' => $pid]);
            }
        }

        EQuickDlgs::render('_formExpenseDetail', ['model' => $model]);
    }

    public function actionVerified($id, $pid)
    {
        $model = $this->loadModelExpense($id);

        if (isset($_POST['gExpense'])) {
            $model->attributes = $_POST['gExpense'];
            $model->approved_id = 3; ///request
            $transportation_type = $model->transportation_type;
            $model->transportation_type = ""; //null for passing validation
            if ($model->save()) {
                if (is_array($transportation_type)) {
                    foreach ($transportation_type as $mod) {
                        $modelDetail = new gExpenseDetail;
                        $modelDetail->parent_id = $model->id;
                        $modelDetail->expense_id = $mod;
                        $modelDetail->save(false);
                    }
                }

                $this->redirect(['/m1/gExpense']);
            }
        }

        $this->render('verifiedWithEmp', [
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
        $model = $this->loadModelExpense($id);

        //if (!isset($_POST['gExpense'])) {
        //    $model->accompanied_by = $model->idToName;
        //}

        if (isset($_POST['gExpense'])) {
            $model->attributes = $_POST['gExpense'];
            if ($model->save())
                //$this->redirect(array('/m1/gExpense'));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('update', ['model' => $model]);
    }

    public function actionUpdateExpenseDetail($id)
    {
        $model = $this->loadModelExpenseDetail($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gExpenseDetail'])) {
            $model->attributes = $_POST['gExpenseDetail'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formExpenseDetail', ['model' => $model]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModelExpense($id)->delete();
    }

    public function actionDeleteExpenseDetail($id)
    {
        $this->loadModelExpenseDetail($id)->delete();
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

    public function actionOnRealization()
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

        $this->render('onRealization', [
            'model' => $model,
        ]);
    }

    public function actionOnProcess()
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

        $this->render('onProcess', [
            'model' => $model,
        ]);
    }

    public function actionOnPaid()
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

        $this->render('onPaid', [
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
        $model = $this->loadModelExpense($id);
        $modelPerson = gPerson::model()->findByPk($pid);

        //if ($model->expense_type_id == 2) { //perjalanan dinas
            $model->approved_id = 2;
            $model->superior_approved_id = 2;
        //} else {
        //    $model->approved_id = 3;
        //    $model->superior_approved_id = 2;
        //}

        $model->process_date = date('d-m-Y');

        $model->save(false);

        /*$this->newInbox([
            'recipient' => $modelPerson->userid,
            'subject' => "Expense Approved. Your Expense has been approved by HR Admin. Don't forget to fill Realization Detail",
            'message' => "Dear " . $model->person->employee_name . ",<br/> <br/>
			Your Expense request on " . $model->input_date . " for: \"" . $model->purpose . "\" with advanced amount " . $model->advanced_amount . " has been approved by HR Admin. <br/> 
			Thank You.. <br/><br/>"
        ]);*/
    }

    public function actionProcess($id, $pid)
    {
        $model = $this->loadModelExpense($id);
        $modelPerson = gPerson::model()->findByPk($pid);


        $model->approved_id = 3;
        $model->superior_approved_id = 2;
        $model->process_date = date('d-m-Y');
        $model->balance = gExpense::model()->lastBalance($model->expense_type_id) - $model->original_amount;

        $model->save(false);

        /*$this->newInbox([
            'recipient' => $modelPerson->userid,
            'subject' => "Expense Process to Finance. Your Expense has been processed by HR Admin to Finance Dept.",
            'message' => "Dear " . $model->person->employee_name . ",<br/> <br/>
            Your Expense request on " . $model->input_date . " for: \"" . $model->purpose . "\" with amount " . $model->original_amount . " has been processed by HR Admin to Finance Dept. <br/> 
            Thank You.. <br/><br/>"
        ]);*/
    }


    public function actionPaid($id, $pid)
    {
        $model = $this->loadModelExpense($id);
        $modelPerson = gPerson::model()->findByPk($pid);

        $model->approved_id = 4;

        $model->save(false);


        /*$this->newInbox([
            'recipient' => $modelPerson->userid,
            'subject' => "Expense Paid. Your Expense has been paid by Finance Department",
            'message' => "Dear " . $model->person->employee_name . ",<br/> <br/>
            Your Expense request on " . $model->input_date . " for: \"" . $model->purpose . "\" has been paid by Finance Department.
             Final approved amount is " . $model->approved_amount . " has been paid by Finance Dept. <br/> 
            Thank You.. <br/><br/>"
        ]);*/
    }

    public function actionUnblock($id, $pid)
    {

        gExpense::model()->updateByPk((int)$id, [
            'approved_id' => 1,
        ]);
    }

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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'g-expense-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPrintExpense($id)
    {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
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
        $criteria->compare('approved_id', 2);

        $model = gExpense::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }


    public function actionExpenseCalendar()
    {
        $this->render('ExpenseCalendar', []);
    }

    public function actionExpenseCalendarAjax()
    {

        $connection = Yii::app()->db;
        $sql = '
			SELECT l.parent_id, l.start_date, l.end_date, t.id, t.employee_name, l.approved_id, s.name 
			FROM g_expense l
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
            $detail['url'] = Yii::app()->createUrl('/m1/gExpense/view', ["id" => $row['id']]);
            $items[] = $detail;
        }

        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionUpdateExpenseAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gExpense'); // 'User' is classname of model to be updated
        $es->update();
    }

}
