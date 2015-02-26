<?php

class ILearningHoldingController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            //'accessControl', // perform access control for CRUD operations
            'rights', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionViewDetail($id)
    {
        $newParticipant = $this->newParticipant($id);
        $newPhoto = $this->newPhoto($id);

        $this->render('viewDetail', [
            'model' => $this->loadModelSchedule($id),
            'modelParticipant' => $newParticipant,
            'modelPhoto' => $newPhoto,
        ]);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionConfirmAll($id)
    {
        $model = $this->loadModelSchedule($id);

        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $model->id);
        $criteria->with = ['employee'];
        $criteria->order = 'employee.employee_name';
        $criteria1 = new CDbCriteria;
        $criteria1->condition = 'certificate_number is null';
        $criteria->mergeWith($criteria1);
        $modelSchParts = iLearningSchPart::model()->findAll($criteria);

        foreach ($modelSchParts as $modelSchPart) {
            $modelSchPart->flow_id = 2;
            $modelSchPart->day1 = 1;
            if ($modelSchPart->getparent->certificate_template_id != 0) {
                $modelSchPart->certificate_number = str_pad(iLearningSchPart::getLastNumber(), 4, "0", STR_PAD_LEFT) . "/SFT/HR-APLC/"
                    . peterFunc::bulanRomawi($model->schedule_date) . "/" . date("Y", strtotime($model->schedule_date));
            }

            $modelSchPart->save(false);

            $link = Yii::app()->request->HostInfo . "/index.php/m1/gEss/viewDetailEss/id/" . $modelSchPart->parent_id;
            $link = "<a href='" . $link . "'>" . $modelSchPart->getparent->schedule_date . "</a>";

            $this->newInbox([
                'recipient' => $modelSchPart->employee->userid,
                'subject' => "Learning portofolio has been set for you",
                'message' => "Dear " . $modelSchPart->employee->employee_name . ",<br/><br/>
            We have just added this following training: " . $modelSchPart->getparent->getparent->learning_title . " that you attend on: 
            " .
                    $link
                    . " into you training portofolio.<br/><br/>
            Congratulations! and we'll see you on next training. Thank You<br/><br/>"
            ]);

        }

        return true;
        /*        $newParticipant = $this->newParticipant($id);
                $newPhoto = $this->newPhoto($id);

                $this->render('viewDetail', [
                    'model' => $this->loadModelSchedule($id),
                    'modelParticipant' => $newParticipant,
                    'modelPhoto' => $newPhoto,
                ]); */
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newParticipant($id)
    {
        $model = new iLearningSchPart;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearningSchPart'])) {
            $model->attributes = $_POST['iLearningSchPart'];
            $model->parent_id = (int)$id;
            $model->flow_id = 1; //Applied, New Entry
            if ($model->save()) {

                $link = Yii::app()->request->HostInfo . "/index.php/m1/gEss/viewDetailEss/id/" . $model->parent_id;
                $link = "<a href='" . $link . "'>" . $model->getparent->schedule_date . "</a>";

                if (strtotime($model->getparent->schedule_date) > time()) {
                    $this->newInbox([
                        'recipient' => $model->employee->userid,
                        'subject' => "Learning schedule has been set for you",
                        'message' => "Dear " . $model->employee->employee_name . ",<br/><br/> 
						Your name has been added to following training: " . $model->getparent->getparent->learning_title . " that will be held on: 
						" .
                            $link
                            . ".<br/><br/>
						Dont forget! and see you there. Thank You<br/><br/>"
                    ]);
                }

                $this->redirect(['viewDetail', 'id' => $id]);
            }
        }

        return $model;
    }

    public function newPhoto($id)
    {
        $model = new fPhoto;

        if (isset($_POST['fPhoto'])) {

            $model->attributes = $_POST['fPhoto'];
            $model->datetime = date("d-m-Y");
            $model->title = "Dummy Title";
            $model->description = "Dummy Description";

            if ($model->validate()) {

                if (!is_dir(Yii::getPathOfAlias('webroot') . '/shareimages/hr/learning/' . $id))
                    mkdir(Yii::getPathOfAlias('webroot') . '/shareimages/hr/learning/' . $id);

                $images = CUploadedFile::getInstancesByName($model->images);

                //if (isset($images) && count($images) > 0) {

                foreach ($images as $image => $pic) {
                    //$pic->saveAs(Yii::getPathOfAlias('webroot') . '/shareimages/hr/learning/' . $id . "/" . $pic->name);
                    $pic->saveAs(Yii::getPathOfAlias('webroot') . '/shareimages/hr/learning/' . $pic->name);
                }

                //change permission
                //chmod(Yii::getPathOfAlias('webroot').'/shareimages/photo/'.date("Ymd")."-".$model->title.".jpg","0777");
                //$model= new fPhoto;
                //}
            }
        }

        return $model;
    }

    public function actionUpload($id)
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        //$folder='shareimages/hr/employee/temp/';  // folder for uploaded files
        $folder = 'shareimages/hr/learning/' . $id . '/'; // folder for uploaded files
        $allowedExtensions = ["jpg"]; //array("jpg","jpeg","gif","exe","mov" and etc...
        //$sizeLimit = 5 * 1024 * 1024;// maximum file size in bytes
        $sizeLimit = 500 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
        $fileName = $result['filename']; //GETTING FILE NAME
        //Make Thumb
        //copy(Yii::getPathOfAlias('webroot').'shareimages/hr/employee/'.$fileName, 
        //Yii::getPathOfAlias('webroot').'shareimages/hr/employee/thumb/'.$fileName);
        //Yii::import('ext.iwi.Iwi');
        //$picture = new Iwi(Yii::app()->basePath . "/../shareimages/hr/employee/".$fileName);
        //$picture->resize(150,250, Iwi::AUTO);
        //$picture->save(Yii::app()->basePath . "/../shareimages/hr/employee/thumb/".$fileName, TRUE);
        //change permission
        //chmod(Yii::getPathOfAlias('webroot').'shareimages/hr/employee/thumb/'.$fileName,"0777");
        //gPerson::model()->updateByPk($id,array('c_pathfoto'=>$id."-".$fileName,'updated_date'=>time(),'updated_by'=>Yii::app()->user->id));
        //gPerson::model()->updateByPk($id, array('c_pathfoto' => $fileName, 'updated_date' => time(), 'updated_by' => Yii::app()->user->id));

        echo $return; // it's array
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $newSchedule = $this->newSchedule($id);

        $this->render('view', [
            'model' => $this->loadModel($id),
            'modelSchedule' => $newSchedule,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newSchedule($id)
    {
        $model = new iLearningSch;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearningSch'])) {
            $model->attributes = $_POST['iLearningSch'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $model->parent_id]);
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new iLearning;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearning'])) {
            $model->attributes = $_POST['iLearning'];
            if ($model->save())
                $this->redirect(['view', 'id' => $model->id]);
        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionFeedback($id)
    {
        $model = iLearningSchPartFb::model()->find('parent_id =' . $id);
        $modelSch = iLearningSchPart::model()->findByPk((int)$id);

        if ($model === null)
            $model = new iLearningSchPartFb;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearningSchPartFb'])) {
            $model->attributes = $_POST['iLearningSchPartFb'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['viewDetail', 'id' => $model->getparent->parent_id]);
        }

        $this->render('feedback', [
            'model' => $model,
            'modelSch' => $modelSch,
        ]);
    }

    public function actionUpdateSchedule($id)
    {
        $model = $this->loadModelSchedule($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearningSch'])) {
            $model->attributes = $_POST['iLearningSch'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formSchedule', ['model' => $model]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearning'])) {
            $model->attributes = $_POST['iLearning'];
            if ($model->save())
                $this->redirect(['view', 'id' => $model->id]);
        }

        $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionConfirm($id)
    {
        $model = $this->loadModelSchedulePart($id);
        $model->flow_id = 2;
        $model->day1 = 1;
        if ($model->getparent->certificate_template_id != 0) {
            $model->certificate_number = str_pad(iLearningSchPart::getLastNumber(), 4, "0", STR_PAD_LEFT) . "/SFT/HR-APLC/"
                . peterFunc::bulanRomawi($model->getparent->schedule_date) . "/" . date("Y", strtotime($model->getparent->schedule_date));
        }
        $model->save(false);

        return true;

    }

    public function actionCancel($id)
    {
        $model = $this->loadModelSchedulePart($id);
        $model->flow_id = 3;
        $model->certificate_number = null;
        $model->save(false);

        return true;

    }

    public function actionUpdateParticipantAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('iLearningSchPart'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionUpdateMandaysAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('iLearningSch'); // 'User' is classname of model to be updated
        $es->update();
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeleteParticipant($id)
    {
        $this->loadModelSchedulePart($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
    }

    public function actionDeleteSchedule($id)
    {
        $this->loadModelSchedule($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['/m1/iLearningHolding']);
    }

    public function actionPrintDetail($id)
    {
        $pdf = new learning1('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->with = ['getparent', 'participant', 'participant.employee', 'participant.employee.company'];
        $criteria->together = true;
        $criteria->order = 'company.company_id';
        $model = iLearningSch::model()->findByPk((int)$id, $criteria);
        if ($model == null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->render('index', [
        ]);
    }

    public function actionCalendarEvents()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('year(schedule_date)', date("Y"));

        $models = iLearningSch::model()->findAll($criteria);

        $items = [];
        $detail = [];
        $input = ["#CC0000", "#0000CC", "#333333", "#663333", "#993333", "#CC3333", "#003366", "#663366", "#993366", "#CC3366", "#6633CC"];
        foreach ($models as $model) {
            $detail['title'] = $model->learning_status . " (" . $model->mPartCount . " / " . $model->partCountConfirm . ")";
            $detail['start'] = date('Y') . '-' . date('m', strtotime($model->schedule_date)) . '-' . date('d', strtotime($model->schedule_date));
            //$detail['start']= $model->schedule_date;
            $detail['color'] = $input[rand(0, 10)];
            $detail['allDay'] = true;
            $detail['url'] = Yii::app()->createUrl('/m1/iLearningHolding/viewDetail', ["id" => $model->id]);
            $items[] = $detail;
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

    /**
     * Lists all models.
     */
    public function actionIndex2()
    {
        $model = new iLearning('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;

        if (isset($_GET['iLearning'])) {
            $model->attributes = $_GET['iLearning'];
            $criteria->compare('learning_title', $_GET['iLearning']['learning_title'], true);
        }

        $criteria->order = 'learning_title';

        $dataProvider = new CActiveDataProvider('iLearning', [
            'criteria' => $criteria,
        ]);

        $this->render('index2', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Lists all models.
     */
    public function actionIndex3()
    {
        $this->render('index3', [
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = iLearning::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
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

    public function loadModelSchedulePart($id)
    {
        $model = iLearningSchPart::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'i-learning-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPersonAutoCompletePhoto()
    {
        $res = [];
        if (isset($_GET['term'])) {

            $qtxt = "select 
        `a`.`id` AS `id`,
        `a`.`employee_name` AS `label`,
        `a`.`c_pathfoto` AS `photo`,
        (select 
                `o`.`name` AS `name`
            from
                (`g_person_career` `c`
                left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
            where
                ((`a`.`id` = `c`.`parent_id`)
                    and (`c`.`status_id` in (" . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ")))
            order by `c`.`start_date` desc
            limit 1) AS `company`,
        (select 
                `o`.`name` AS `name`
            from
                (`g_person_career` `c`
                left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
            where
                ((`a`.`id` = `c`.`parent_id`)
                    and (`c`.`status_id` in (" . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ")))
            order by `c`.`start_date` desc
            limit 1) AS `department`,
        (select 
                `o`.`name` AS `name`
            from
                (`g_person_career` `s`
                left join `g_param_level` `o` ON ((`o`.`id` = `s`.`level_id`)))
            where
                (`s`.`parent_id` = `a`.`id`)
            order by `s`.`start_date` desc
            limit 1) AS `level`
    from
        `g_person` `a` WHERE `a`.`employee_name` LIKE :name 
			AND  (select `s`.`status_id` AS `status_id` from `g_person_status` `s` where `s`.`parent_id` = `a`.`id` order by `s`.`start_date` desc limit 1) NOT IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ") 
			ORDER BY `a`.`employee_name` LIMIT 20
        ";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionLearningAutoComplete()
    {
        $res = [];
        if (isset($_GET['term'])) {
            $qtxt = "SELECT learning_title as label, id FROM i_learning 
			WHERE learning_title LIKE :name 
			ORDER BY learning_title LIMIT 20";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionPrint($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);

        $model = iLearningSchPart::model()->find($criteria);

        $pdf = new learningCertificate1('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetAutoPageBreak(0, 0);
        $pdf->SetMargins(0, 1);

        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }


    public function actionUpdateScheduleAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('iLearningSch'); // 'User' is classname of model to be updated
        $es->update();
    }

}
