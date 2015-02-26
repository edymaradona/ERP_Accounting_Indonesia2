<?php

class HApplicantController extends Controller
{

    public $layout = '//layouts/column2left';

    //public $layout='//layouts/column3leftW';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'rights', // perform access control for CRUD operations
        ];
    }

    public function actionCreate()
    {
        $model = new hApplicant;
        $model->setScenario('create');
        $password = peterFunc::rand_string(8);

        if (isset($_POST['hApplicant'])) {
            $model->attributes = $_POST['hApplicant'];
            $model->id = Yii::app()->user->id;
            if ($model->validate()) {

                $mod = new sUserRegistration;
                $mod->module_name = 'Recruitment BU';
                $salt = md5(uniqid('', true));
                $mod->email = $_POST['hApplicant']['email'];
                $mod->activation_code = $salt;
                $mod->password = md5($salt . $password);
                $mod->registration_date = time();
                $mod->status_id = 2; //auto Update

                $mod->save(false);
                //
                $model->id = $mod->id; //overrride default user;
                $model->company_id = sUser::model()->myGroup;
                $model->save(false);

                Yii::app()->user->setFlash('info', '<strong>Please note this Password!</strong> 
				every time you create a new applicant with this form, it also will automatically create new USER REGISTRATION:</br>
				USERNAME: ' . $model->email . '</br>
				PASSWORD: ' . $password . '<br/>
				This username and password is a valid access to: ' . Yii::app()->params["webcareer"] . '<br/>
				Please write it down!!! This box is only display once. If you forgot the password, you can ask admin to reset the password...');

                $this->redirect(['view', 'id' => $model->id]);
            }
        }


        $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionIndex($id = 0)
    {
        $model = new hApplicant('search');
        $model->unsetAttributes(); // clear any default values

        $criteria = new CDbCriteria;
        if (Yii::app()->user->name != "admin") {
            $criteria->compare('company_id', sUser::model()->myGroup, false, 'OR');
            $criteria->compare('company_id', 0, false, 'OR');
        }

        if (isset($_GET['hApplicant'])) {
            $model->attributes = $_GET['hApplicant'];

            $criteria1 = new CDbCriteria;
            $criteria1->with = ['many_experience', 'many_education'];
            $criteria1->together = true;
            $criteria1->compare('applicant_name', $_GET['hApplicant']['applicant_name'], true, 'OR');
            $criteria1->compare('many_experience.job_description', $_GET['hApplicant']['applicant_name'], true, 'OR');
            $criteria1->compare('many_experience.job_title', $_GET['hApplicant']['applicant_name'], true, 'OR');

            if ($_GET['hApplicant']['sex_id'] != 0)
                $criteria1->compare('sex_id', $_GET['hApplicant']['sex_id']);

            if ($_GET['hApplicant']['education_level'] != 0)
                $criteria1->compare('many_education.level_id', $_GET['hApplicant']['education_level']);

            $criteria->mergeWith($criteria1);
        }

        if (isset($_GET['tag'])) {

            $criteria2 = new CDbCriteria;
            $criteria2->with = ['many_experience'];
            $criteria2->together = true;
            $criteria2->compare('many_experience.job_title', $_GET['tag']);
            $criteria->mergeWith($criteria2);
        }


        $dataProvider = new CActiveDataProvider('hApplicant', [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'created_date DESC',
            ]
        ]);


        $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionComment($id)
    {

        if (isset($_POST['hApplicantComment'])) {
            $model = new hApplicantComment;
            $model->attributes = $_POST['hApplicantComment'];
            $model->parent_id = (int)$id;
            $model->user_id = Yii::app()->user->id;
            $model->save(false);
        }
        return true;
    }

    public function actionFilter()
    {
        $model = new fApplicant;
        $model->unsetAttributes(); // clear any default values

        $criteria = new CDbCriteria;
        $criteria->compare('company_id', sUser::model()->myGroup, false, 'OR');
        $criteria->compare('company_id', 0, false, 'OR');

        $criteria1 = new CDbCriteria;

        if (isset($_GET['fApplicant'])) {
            //$model->attributes=$_GET['fApplicant'];
            $criteria->with = ['many_education', 'many_experience'];
            $criteria->together = true;

            //$criteria->compare('sex_id',$_GET['fApplicant']['sex_id']);
            //$criteria->compare('many_education.level_id',$_GET['fApplicant']['education_id']);

            $criteria1->addSearchCondition('applicant_name', $_GET['fApplicant']['keyword'], true, 'OR');
            $criteria1->addSearchCondition('many_experience.job_title', $_GET['fApplicant']['keyword'], true, 'OR');

            $criteria->mergeWith($criteria1);
        }

        $dataProvider = new CActiveDataProvider('hApplicant', [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'created_date DESC',
            ],
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);


        $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {

        $modelSelection = $this->newSelection($id);
        $modelFamily = $this->newFamily($id);
        $modelEducation = $this->newEducation($id);
        $modelEducationNf = $this->newEducationNf($id);
        $modelExperience = $this->newExperience($id);

        $this->render('view', [
            'model' => $this->loadModel($id),
            'modelSelection' => $modelSelection,
            'modelFamily' => $modelFamily,
            'modelEducation' => $modelEducation,
            'modelEducationNf' => $modelEducationNf,
            'modelExperience' => $modelExperience,
        ]);
    }

    public function newSelection($id)
    {
        $model = new hApplicantSelection;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicantSelection'])) {
            $model->attributes = $_POST['hApplicantSelection'];
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
    public function newFamily($id)
    {
        $model = new hApplicantFamily;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicantFamily'])) {
            $model->attributes = $_POST['hApplicantFamily'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['/m1/hApplicant/view', 'id' => $id]);
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newEducation($id)
    {
        $model = new hApplicantEducation;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicantEducation'])) {
            $model->attributes = $_POST['hApplicantEducation'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['/m1/hApplicant/view', 'id' => $id]);
        }

        return $model;
    }

    public function newEducationNf($id)
    {
        $model = new hApplicantEducationNf;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicantEducationNf'])) {
            $model->attributes = $_POST['hApplicantEducationNf'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['/m1/hApplicant/view', 'id' => $id]);
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newExperience($id)
    {
        $model = new hApplicantExperience;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicantExperience'])) {
            $model->attributes = $_POST['hApplicantExperience'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['/m1/hApplicant/view', 'id' => $id]);
        }

        return $model;
    }

    public function actionUpdateFamily($id)
    {
        $model = $this->loadModelFamily($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicantFamily'])) {
            $model->attributes = $_POST['hApplicantFamily'];
            if ($model->save())
                //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formFamily', ['model' => $model]);
    }

    public function actionUpdateEducation($id)
    {
        $model = $this->loadModelEducation($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicantEducation'])) {
            $model->attributes = $_POST['hApplicantEducation'];
            if ($model->save())
                //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formEducation', ['model' => $model]);
    }

    public function actionUpdateEducationNf($id)
    {
        $model = $this->loadModelEducationNf($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicantEducationNf'])) {
            $model->attributes = $_POST['hApplicantEducationNf'];
            if ($model->save())
                //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formEducationNf', ['model' => $model]);
    }

    public function actionUpdateExperience($id)
    {
        $model = $this->loadModelExperience($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicantExperience'])) {
            $model->attributes = $_POST['hApplicantExperience'];
            if ($model->save())
                //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formExperience', ['model' => $model]);
    }

    public function actionDeleteFamily($id)
    {
        $this->loadModelFamily($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['/applicant']);
    }

    public function actionDeleteEducation($id)
    {
        $this->loadModelEducation($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['/applicant']);
    }

    public function actionDeleteEducationNf($id)
    {
        $this->loadModelEducationNf($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['/applicant']);
    }

    public function actionDeleteExperience($id)
    {
        $this->loadModelExperience($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['/applicant']);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $model->setScenario('update');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicant'])) {
            $model->attributes = $_POST['hApplicant'];
            if ($model->save())
                $this->redirect(['/m1/hApplicant/view', 'id' => $model->id]);
        }

        $this->render('update', [
            'model' => $model,
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
            $criteria->compare('company_id', sUser::model()->myGroup, false, 'OR');
            $criteria->compare('company_id', 0, false, 'OR');
        }
        $model = hApplicant::model()->findByPk((int)$id, $criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelFamily($id)
    {
        $model = hApplicantFamily::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelEducation($id)
    {
        $model = hApplicantEducation::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelEducationNf($id)
    {
        $model = hApplicantEducationNf::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelExperience($id)
    {
        $model = hApplicantExperience::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function actionPrintCv($id)
    {
        $pdf = new cv('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        //$model=gPerson::model()->findByPk((int)$id);
        $pdf->report($id);

        $pdf->Output();
    }

    public function actionTransfer($id)
    {
        $model = $this->loadModel($id);

        $modelPerson = new gPerson;
        $modelPerson->employee_name = $model->applicant_name;
        $modelPerson->birth_place = $model->birth_place;
        $modelPerson->birth_date = $model->birth_date;
        $modelPerson->sex_id = $model->sex_id;
        $modelPerson->religion_id = $model->religion_id;
        $modelPerson->address1 = $model->address1;
        $modelPerson->email = $model->email;
        $modelPerson->identity_number = $model->identity_number;
        $modelPerson->c_pathfoto = $model->c_pathfoto;
        $modelPerson->save(false);

        $modelCareer = new gPersonCareer;
        $modelCareer->parent_id = $modelPerson->id;
        $modelCareer->start_date = date("d-m-Y"); //start Today
        $modelCareer->status_id = 1; //Join New
        $modelCareer->company_id = $model->schedule->company_id;
        $modelCareer->department_id = $model->schedule->department_id;
        $modelCareer->level_id = $model->schedule->level_id;
        $modelCareer->job_title = $model->schedule->for_position;
        $modelCareer->reason = "MIGRATE FROM SELECTION";
        $modelCareer->save(false);

        $modelStatus = new gPersonStatus;
        $modelStatus->parent_id = $modelPerson->id;
        $modelStatus->start_date = date("d-m-Y"); //start Today
        $modelStatus->status_id = 1; //Contract I
        $modelStatus->remark = "MIGRATE FROM SELECTION";
        $modelStatus->save(false);

        foreach ($model->many_experience as $modExp) {
            $modelExperience = new gPersonExperience;
            $modelExperience->parent_id = $modelPerson->id;
            $modelExperience->company_name = $modExp->company_name;
            $modelExperience->industries = $modExp->industries;
            $modelExperience->start_date = $modExp->start_date;
            $modelExperience->end_date = $modExp->end_date;
            $modelExperience->job_title = $modExp->job_title;
            $modelExperience->job_description = $modExp->job_description;
            $modelExperience->save(false);
        }

        foreach ($model->many_education as $modEdu) {
            $modelEducation = new gPersonEducation;
            $modelEducation->parent_id = $modelPerson->id;
            $modelEducation->level_id = $modEdu->level_id;
            $modelEducation->school_name = $modEdu->school_name;
            $modelEducation->interest = $modEdu->interest;
            $modelEducation->graduate = $modEdu->graduate;
            $modelEducation->country = $modEdu->country;
            $modelEducation->ipk = $modEdu->ipk;
            $modelEducation->save(false);
        }

        foreach ($model->many_family as $modFam) {
            $modelFamily = new gPersonFamily;
            $modelFamily->parent_id = $modelPerson->id;
            $modelFamily->f_name = $modFam->f_name;
            $modelFamily->relation_id = $modFam->relation_id;
            $modelFamily->birth_place = $modFam->birth_place;
            $modelFamily->birth_date = $modFam->birth_date;
            $modelFamily->sex_id = $modFam->sex_id;
            $modelFamily->remark = $modFam->remark;
            $modelFamily->save(false);
        }

        foreach ($model->many_educationnf as $modEdunf) {
            $modelEducationnf = new gPersonEducationNf;
            $modelEducationnf->parent_id = $modelPerson->id;
            $modelEducationnf->education_name = $modEdunf->education_name;
            $modelEducationnf->category = $modEdunf->category;
            $modelEducationnf->start = $modEdunf->start;
            $modelEducationnf->end = $modEdunf->end;
            $modelEducationnf->sertificate = $modEdunf->sertificate;
            $modelEducationnf->save(false);
        }

        $modelAppSel = new hApplicantSelection;
        $modelAppSel->parent_id = $model->id;
        $modelAppSel->workflow_id = 19; //User Decision
        $modelAppSel->workflow_result_id = 3; //Join
        $modelAppSel->workflow_by = "SYSTEM"; //Join
        $modelAppSel->assessment_date = date("d-m-Y"); //start Today
        $modelAppSel->assessment_summary = "AUTOMATE DATA INSERTION";
        $modelAppSel->development_area = "AUTOMATE DATA INSERTION";
        $modelAppSel->save(false);

        $modelAppCom = new hApplicantComment;
        $modelAppCom->parent_id = $model->id;
        $modelAppCom->user_id = Yii::app()->user->id;
        $modelAppCom->status_id = 1; //Default
        $modelAppCom->comment = "SYSTEM. Join as employee as Company: " . $modelPerson->company->company->name .
            ", Department: " . $modelPerson->company->department->name . ", Start: " . $modelPerson->company->start_date;
        $modelAppCom->save(false);


        Yii::app()->user->setFlash('success', '<strong>Well done!</strong> Transfer Data to Person Admin has been successfully');
        $this->redirect(['/m1/gPerson/view', "id" => $modelPerson->id]);
    }

    public function actionWorkflowUpdate()
    {
        $cat_id = $_POST['hApplicantSelection']['workflow_id'];
        $mcat = gParamSelection::model()->findByPk((int)$cat_id);

        if ($mcat->getparent->id == 1) {
            $models = sParameter::model()->findAll(['condition' => 'type = "cSelectionInvitation"', 'order' => 'code']);
        } elseif ($mcat->getparent->id == 5) {
            $models = sParameter::model()->findAll(['condition' => 'type = "cSelectionState"', 'order' => 'code']);
        } else
            $models = sParameter::model()->findAll(['condition' => 'type = "cSelectionResult"', 'order' => 'code']);

        foreach ($models as $model) {
            $_items[$model->code] = $model->name;
        }

        echo CHtml::tag('option', ['value' => ""], ".:Not Set:.", true);
        foreach ($_items as $value => $dept) {
            echo CHtml::tag('option', ['value' => $value], CHtml::encode($dept), true);
        }
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

}
