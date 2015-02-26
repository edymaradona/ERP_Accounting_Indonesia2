<?php

class GMedicalController extends Controller
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
        $model = new gMedical;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gMedical'])) {
            $model->attributes = $_POST['gMedical'];
            $model->input_date = date('d-m-Y');
            $model->approved_id = 1; ///request
            if ($model->save())
                $this->redirect(['/m1/gMedical']);
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
        $model = $this->loadModelMedical($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gMedical'])) {
            $model->attributes = $_POST['gMedical'];
            if ($model->save())
                //$this->redirect(array('/m1/gMedical'));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('update', ['model' => $model]);
    }

    public function actionUpdateAmount($id)
    {
        $model = $this->loadModelMedical($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gMedical'])) {
            $model->attributes = $_POST['gMedical'];
            if ($model->save())
                //$this->redirect(array('/m1/gMedical'));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('updateAmount', ['model' => $model]);
    }

    public function actionUpdateAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gMedical'); // 'User' is classname of model to be updated
        $es->update();
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
            $this->loadModelMedical($id)->delete();

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
            $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id 
                IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) 
                IN (' . implode(",", sUser::model()->myGroupArray) . ') 
                OR ' .
                '(select c3.company_id from g_person_costcenter c3 WHERE t.id=c3.parent_id AND c3.company_id IN (' .
                implode(",", sUser::model()->myGroupArray) . ') ORDER BY c3.start_date DESC LIMIT 1) IN (' .
                implode(",", sUser::model()->myGroupArray) . ')';
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

    public function actionProcess($id, $pid, $type_id)
    {
        $model = $this->loadModelMedical($id);


        $model->approved_id = 2;
        $model->superior_approved_id = 2;
        $model->process_date = date('d-m-Y');
        if ($model->medical_type->medical_company_id == 1) {

            $output = parse_ini_string($model->lastFormula);
            $amount = $model->original_amount;
            $s = '$total=' . str_replace('{amount}', $amount, $output['formula']) . ';';
            eval($s);

            $model->approved_amount = $total;
            $model->balance = gMedical::model()->lastBalance($pid, $type_id) - $model->approved_amount;
        } else
            $model->balance = 0;

        $model->save(false);

        $this->newInbox([
            'recipient' => $model->person->userid,
            'subject' => "Medical Process. Your Medical has been processed by HR Admin to Insurance Company",
            'message' => "Dear " . $model->person->employee_name . ",<br/> <br/>
			Your Medical request on " . $model->input_date . " for: \"" . $model->sympthom . "\" with amount " . $model->original_amount . " has been processed by HR Admin to Insurance Company. <br/> 
			Thank You.. <br/><br/>"
        ]);
    }

    public function actionPaid($id, $pid)
    {
        $model = $this->loadModelMedical($id);

        $model->approved_id = 3;

        if ($model->approved_amount == 0)
            $model->approved_amount = $model->original_amount;

        $model->save(false);


        $this->newInbox([
            'recipient' => $model->person->userid,
            'subject' => "Medical Paid. Your Medical has been paid by Insurance Company",
            'message' => "Dear " . $model->person->employee_name . ",<br/> <br/>
            Your Medical request on " . $model->input_date . " for: \"" . $model->sympthom . "\" has been paid by Insurance Company.
             Final approved amount is " . $model->approved_amount . " has been paid by Insurance Company. <br/> 
            Thank You.. <br/><br/>"
        ]);
    }

    public function actionUnblock($id, $pid)
    {

        gMedical::model()->updateByPk((int)$id, [
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
                implode(",", sUser::model()->myGroupArray) . ') 
                OR ' .
                '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
                implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                implode(",", sUser::model()->myGroupArray) . ')
                OR ' .
                '(select c3.company_id from g_person_costcenter c3 WHERE t.id=c3.parent_id AND c3.company_id IN (' .
                implode(",", sUser::model()->myGroupArray) . ') ORDER BY c3.start_date DESC LIMIT 1) IN (' .
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
    public function loadModelMedical($id)
    {
        $model = gMedical::model()->findByPk($id);
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

    public function actionPrintMedical($id)
    {
        $pdf = new medicalForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('approved_id', 1);

        $model = gMedical::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

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

        $model = gMedical::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionWeeklyReport()
    {
        $pdf = new medicalWeekly('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $connection = Yii::app()->db;
        $sql = "SELECT a.employee_name, if (p.medical_for_id = 0, a.employee_name, f.f_name) as Medical_for, a.company, a.department, a.level, a.join_date, a.job_title,
                p.medical_type_id, p.input_date, p.receipt_date, p.sympthom, p.original_amount, p.remark, g.name,
                p.general_doctor, p.specialist_doctor, p.medicine, p.doctor_medicine, p.administration, p.physiotherapy,p.diagnostics
            FROM g_medical p  
            INNER JOIN g_param_medical g ON g.id = p.medical_type_id
            INNER JOIN g_bi_person_lite a ON p.parent_id = a.id
            LEFT JOIN g_person_family f ON p.medical_for_id = f.id
            WHERE a.company_id = " . sUser::model()->myGroup . " AND p.approved_id = 1 
            ORDER by p.medical_type_id, a.employee_name,p.input_date";

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        if ($rows === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($rows);

        $pdf->Output();
    }

    public function actionMedicalCalendar()
    {
        $this->render('MedicalCalendar', []);
    }

    public function actionMedicalCalendarAjax()
    {

        $connection = Yii::app()->db;
        $sql = '
			SELECT l.parent_id, l.start_date, l.end_date, t.id, t.employee_name, l.approved_id, s.name 
			FROM g_medical l
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
            $detail['url'] = Yii::app()->createUrl('/m1/gMedical/view', ["id" => $row['id']]);
            $items[] = $detail;
        }

        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionUpdateMedicalAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gMedical'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionFamilyUpdate()
    {

        $cat_id = $_POST['gMedical']['parent_id'];
        $_items = [];

        $models = gPersonFamily::model()->findAll(['condition' => 'payroll_cover_id = 1 AND parent_id = ' . $cat_id, 'order' => 'relation_id']);
        $modPerson = gPerson::model()->findByPk((int)$cat_id);

        if ($modPerson != null) {
            $myself = $modPerson->employee_name . " ( self | " . $modPerson->countAgeRoundDown() . " years )";
            echo CHtml::tag('option', ['value' => 0], CHtml::encode($myself), true);
        }

        if ($models != null) {
            //echo CHtml::tag('option', ['value' => 0], CHtml::encode($myself), true);

            foreach ($models as $model)
                $_items[$model->id] = $model->f_name . " ( " . $model->relation->name . " | " . $model->countAgeRoundDown() . " years )";


            foreach ($_items as $value => $fam) {
                echo CHtml::tag('option', ['value' => $value], CHtml::encode($fam), true);
            }
        }
    }

    public function actionReportByDept()
    {
        $model = new fBeginEndDate;

        if (isset($_POST['fBeginEndDate'])) {
            $model->attributes = $_POST['fBeginEndDate'];
            if ($model->validate()) {

                if ($model->report_id == 1) { //Detail
                    $pdf = new medicalSummaryByDept('L', 'mm', 'A4');
                    $pdf->AliasNbPages();
                    $pdf->AddPage();
                    $pdf->SetFont('Arial', '', 12);

                    $connection = Yii::app()->db;
                    $sql = "SELECT a.employee_name, a.company, a.department, a.level, a.join_date, a.job_title
                        FROM g_bi_person_lite a
                        WHERE company_id = " . sUser::model()->myGroup . " AND employee_status NOT IN ('Resign','End of Contract','Black List','Termination')
                        ORDER by a.department, a.employee_name";

                    $command = $connection->createCommand($sql);
                    $rows = $command->queryAll();

                    $pdf->report($rows);
                } //else

                $pdf->Output();
            }
        }

        $this->render('reportByDept', ['model' => $model]);
    }
}
