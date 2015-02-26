<?php

class GLoanController extends Controller
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
        $modelPayment = $this->newPayment($id);

        $this->render('view', [
            'model' => $this->loadModel($id),
            'modelPayment' => $modelPayment,
        ]);
    }

    public function newPayment($id)
    {
        $model = new gLoan;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLoan'])) {
            $model->attributes = $_POST['gLoan'];
            $model->input_date = date('d-m-Y');
            $model->parent_id = (int)$id;
            $model->debit = 0;

            if ($model->save())
                $this->redirect(['view', 'id' => $id]);
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new gLoan;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLoan'])) {
            $model->attributes = $_POST['gLoan'];
            $model->input_date = date('d-m-Y');
            $model->approved_id = 1; ///request
            if ($model->save())
                $this->redirect(['/m1/gLoan']);
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
        $model = $this->loadModelLoan($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLoan'])) {
            $model->attributes = $_POST['gLoan'];
            if ($model->save())
                //$this->redirect(array('/m1/gLoan'));
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
            $this->loadModelLoan($id)->delete();

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

    public function actionOnOutstanding()
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

        $this->render('onOutstanding', [
            'model' => $model,
        ]);
    }

    public function actionOnPending()
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

        $this->render('onPending', [
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

    public function actionProcess($id, $pid)
    {
        $model = $this->loadModelLoan($id);
        $modelPerson = gPerson::model()->findByPk($pid);


        $model->approved_id = 2;
        $model->superior_approved_id = 2;
        $model->process_date = date('d-m-Y');
        $model->balance = gLoan::model()->lastBalance($model->loan_type_id) + $model->debit - $model->credit;

        $model->save(false);

        $this->newInbox([
            'recipient' => $modelPerson->userid,
            'subject' => "Loan Process. Your Loan has been processed by HR Admin to Finance Department",
            'message' => "Dear " . $model->person->employee_name . ",<br/> <br/>
			Your Loan request on " . $model->input_date . " for: \"" . $model->purpose . "\" with amount " . $model->debit . " has been processed by HR Admin to Insurance Company. <br/> 
			Thank You.. <br/><br/>"
        ]);
    }

    public function actionPaid($id, $pid)
    {
        $model = $this->loadModelLoan($id);
        $modelPerson = gPerson::model()->findByPk($pid);

        $model->approved_id = 3;

        if ($model->approved_amount == 0)
            $model->approved_amount = $model->debit;

        $model->save(false);


        $this->newInbox([
            'recipient' => $modelPerson->userid,
            'subject' => "Loan Paid. Your Loan has been paid by Finance Department",
            'message' => "Dear " . $model->person->employee_name . ",<br/> <br/>
            Your Loan request on " . $model->input_date . " for: \"" . $model->purpose . "\" has been paid by Finance Department.
             Final approved amount is " . $model->approved_amount . " has been paid by Insurance Company. <br/> 
            Thank You.. <br/><br/>"
        ]);
    }

    public function actionUnblock($id, $pid)
    {

        gLoan::model()->updateByPk((int)$id, [
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
    public function loadModelLoan($id)
    {
        $model = gLoan::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'g-loan-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPrintLoan($id)
    {
        $pdf = new LoanForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('approved_id', 1);

        $model = gLoan::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionLoanCalendar()
    {
        $this->render('loanCalendar', []);
    }

    public function actionLoanCalendarAjax()
    {

        $connection = Yii::app()->db;
        $sql = '
			SELECT l.parent_id, l.start_date, l.end_date, t.id, t.employee_name, l.approved_id, s.name 
			FROM g_loan l
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
            $detail['url'] = Yii::app()->createUrl('/m1/gLoan/view', ["id" => $row['id']]);
            $items[] = $detail;
        }

        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionUpdateLoanAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gLoan'); // 'User' is classname of model to be updated
        $es->update();
    }

}
