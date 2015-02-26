<?php

class GPerformanceController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $defaultAction = 'index2';

    /*
      public function filters()
      {
      return array(
      'accessControl', // perform access control for CRUD operations
      'ajaxOnly + PersonAutoComplete',
      array(
      'COutputCache +index',
      // will expire in a year
      'duration'=>24*3600*365,
      'dependency'=>array(
      'class'=>'CChainedCacheDependency',
      'dependencies'=>array(
      new CGlobalStateCacheDependency('gperson'),
      new CDbCacheDependency('SELECT id FROM g_person
      ORDER BY id DESC LIMIT 1'),
      ),
      ),
      ),
      );
      }
     */

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'rights',
            'ajaxOnly + PersonAutoComplete',
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $year = 0)
    {

        if (!is_dir(Yii::getPathOfAlias('webroot.sharedocs.personalperformance') . '/' . Yii::app()->user->name))
            mkdir(Yii::getPathOfAlias('webroot.sharedocs.personalperformance') . '/' . Yii::app()->user->name);

        if ($year == 0)
            $year = date('Y');

        $this->layout = '//layouts/column1';

        $model = $this->loadModel($id);
        $modelPerformanceP = $this->newPerformanceP($id, $year);
        $modelFinalRating = $this->newFinalRating($id, $year);
        $modelPotential = $this->newPotential($id, $year);
        $modelTargetSetting = $this->newTargetSetting($id, $year);
        $modelCoreCompetency = $this->newCoreCompetency($id, $year, $model);
        $modelLeadershipCompetency = $this->newLeadershipCompetency($id, $year, $model);
        $modelWorkResult = $this->newWorkResult($id, $year);

        $this->render('view', [
            'model' => $model,
            'modelPerformanceP' => $modelPerformanceP,
            'modelFinalRating' => $modelFinalRating,
            'modelPotential' => $modelPotential,
            'modelTargetSetting' => $modelTargetSetting,
            'modelCoreCompetency' => $modelCoreCompetency,
            'modelLeadershipCompetency' => $modelLeadershipCompetency,
            'modelWorkResult' => $modelWorkResult,
            'year' => $year,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newPerformanceP($id, $year = 0)
    {
        $model = new fPerformance;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['fPerformance'])) {
            $model->attributes = $_POST['fPerformance'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'year' => $year,]);
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newFinalRating($id, $year = 0)
    {
        $model = new gTalentPerformance;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentPerformance'])) {
            $model->attributes = $_POST['gTalentPerformance'];
            $model->parent_id = (int)$id;
            //$model->pa_value = strtoupper($model->pa_value);
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'year' => $year]);
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newPotential($id, $year = 0)
    {
        $model = new gTalentPotential;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentPotential'])) {
            $model->attributes = $_POST['gTalentPotential'];
            $model->input_date = date('d-m-Y');
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'year' => $year]);
        }

        return $model;
    }

    public function newTargetSetting($id, $year = 0)
    {
        $model = new gTalentTargetSetting;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentTargetSetting'])) {
            $model->attributes = $_POST['gTalentTargetSetting'];
            $model->year = $year;
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'year' => $year, 'tab' => 'Work Result']);
        }

        return $model;
    }

    public function newCoreCompetency($id, $year = 0, $mod)
    {
        $model = new gTalentCoreCompetency;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentCoreCompetency'])) {
            $model->attributes = $_POST['gTalentCoreCompetency'];
            $model->year = $year;
            $model->parent_id = (int)$id;
            $model->level_id = $mod->mGolonganId();
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'year' => $year, 'tab' => 'Core Competency']);
        }

        return $model;
    }

    public function newLeadershipCompetency($id, $year = 0, $mod)
    {
        $model = new gTalentLeadershipCompetency;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentLeadershipCompetency'])) {
            $model->attributes = $_POST['gTalentLeadershipCompetency'];
            $model->year = $year;
            $model->parent_id = (int)$id;
            $model->level_id = $mod->mGolonganId();
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'year' => $year]);
        }

        return $model;
    }

    public function newWorkResult($id, $year = 0)
    {
        $model = new gTalentWorkResult;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentWorkResult'])) {
            $model->attributes = $_POST['gTalentWorkResult'];
            $model->year = $year;
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'year' => $year]);
        }

        return $model;
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdatePerformance($id)
    {
        $model = $this->loadModelPerformance($id);
        $this->loadModel($model->parent_id); //trap security

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentPerformance'])) {
            $model->attributes = $_POST['gTalentPerformance'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formFinalRating', ['model' => $model]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdatePotential($id)
    {
        $model = $this->loadModelPotential($id);
        $this->loadModel($model->parent_id); //trap security

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentPotential'])) {
            $model->attributes = $_POST['gTalentPotential'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formPotential', ['model' => $model]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeletePerformance($id)
    {
        $this->loadModelPerformance($id)->delete();
        $this->loadModel($model->parent_id); //trap security

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        //if (!isset($_GET['ajax']))
        //    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        return true;
    }

    public function actionUpdateTargetSetting($id, $year = 0)
    {
        $model = $this->loadModelTargetSetting($id);
        $this->loadModel($model->parent_id); //trap security

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentTargetSetting'])) {
            $model->attributes = $_POST['gTalentTargetSetting'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formTargetSetting', ['model' => $model, 'year' => $year]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeletePotential($id)
    {
        $model = $this->loadModelPotential($id);
        $this->loadModel($model->parent_id); //trap security
        $model->delete();

        return true;
    }

    public function actionDeleteTargetSetting($id)
    {
        $model = $this->loadModelTargetSetting($id);
        $this->loadModel($model->parent_id); //trap security
        $model->delete();
        return true;
    }

    public function actionUpdateFinalRatingAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gTalentPerformance'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionUpdateTargetAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gTalentTargetSetting'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionUpdateCoreCompetencyAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gTalentCoreCompetency'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionUpdateLeadershipCompetencyAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gTalentLeadershipCompetency'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionUpdateWorkResultAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gTalentWorkResult'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionDeleteCoreCompetency($id)
    {
        $model = $this->loadModelCoreCompetency($id);
        $this->loadModel($model->parent_id); //trap security
        $model->delete();

        return true;
    }

    public function actionDeleteLeadershipCompetency($id)
    {
        $model = $this->loadModelLeadershipCompetency($id);
        $this->loadModel($model->parent_id); //trap security
        $model->delete();
        return true;
    }

    public function actionDeleteWorkResult($id)
    {
        $model = $this->loadModelWorkResult($id);
        $this->loadModel($model->parent_id); //trap security
        $model->delete();

        return true;
    }

    public function actionDeleteCompetencyProfile($id)
    {
        $model = $this->loadModelCompetencyProfile($id);
        $this->loadModel($model->parent_id); //trap security
        $model->delete();

        return true;
    }

    public function actionGenerateWorkResult($id, $year = 0)
    {
        if ($year == 0)
            $year = date('Y');

        $model = $this->loadModel($id); //trap security

        if ($model->mGolonganId() >= 7) {
            $sql = '
                INSERT INTO g_talent_work_result
                 (parent_id, year, talent_template_id,created_date,created_by,updated_date,updated_by) VALUES 
                 (' . $id . ', ' . $year . ', 11,' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 12,' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 13,' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 16,' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 17,' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . ')
            ';
        } else {
            $sql = '
                INSERT INTO g_talent_work_result
                 (parent_id, year, talent_template_id,created_date,created_by,updated_date,updated_by) VALUES 
                 (' . $id . ', ' . $year . ', 18,' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 19,' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 20,' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 21,' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 22,' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . ')
            ';
        }


        $command = Yii::app()->db->createCommand($sql);
        $command->execute();

        $this->redirect(['/m1/gPerformance/view', 'id' => $id, 'year' => $year, 'tab' => 'Work Result']);
    }

    public function actionGenerateCoreCompetency($id, $year = 0)
    {
        if ($year == 0)
            $year = date('Y');

        $model = $this->loadModel($id); //trap security

        if ($model->mGolonganId() >= 7) {
            $sql = '
                INSERT INTO g_talent_core_competency
                 (parent_id, year, talent_template_id,level_id,level2_id,created_date,created_by,updated_date,updated_by) VALUES 
                 (' . $id . ', ' . $year . ', 1,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 2,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 3,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 4,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 5,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . ')
            ';
        } else {
            $sql = '
                INSERT INTO g_talent_core_competency
                 (parent_id, year, talent_template_id,level_id,level2_id,created_date,created_by,updated_date,updated_by) VALUES 
                 (' . $id . ', ' . $year . ', 23,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 24,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 25,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 26,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
                 (' . $id . ', ' . $year . ', 27,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . ')
            ';
        }


        $command = Yii::app()->db->createCommand($sql);
        $command->execute();

        $this->redirect(['/m1/gPerformance/view', 'id' => $id, 'year' => $year, 'tab' => 'Core Competency']);
    }

    public function actionGenerateLeadershipCompetency($id, $year = 0)
    {
        if ($year == 0)
            $year = date('Y');

        $model = $this->loadModel($id);


        $command = Yii::app()->db->createCommand('
			INSERT INTO g_talent_leadership_competency
			 (parent_id, year, talent_template_id,level_id,level2_id,created_date,created_by,updated_date,updated_by) VALUES 
             (' . $id . ', ' . $year . ', 6,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
             (' . $id . ', ' . $year . ', 7,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
             (' . $id . ', ' . $year . ', 8,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
             (' . $id . ', ' . $year . ', 9,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . '),
             (' . $id . ', ' . $year . ', 10,' . $model->mGolonganId() . ',' . $model->mGolonganId() . ',' . time() . ',' . yii::app()->user->id . ',' . time() . ',' . yii::app()->user->id . ')
		');
        $command->execute();

        $this->redirect(['/m1/gPerformance/view', 'id' => $id, 'year' => $year, 'tab' => 'Leadership Compentency']);
    }

    public function actionIndex()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (Yii::app()->user->name != "admin") {
            $criteria->with = ['company'];
            $criteria->addInCondition('company.company_id', sUser::model()->myGroupArray);
        }

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('address1',$_GET['gPerson']['address1'],true,'OR');
        }

        $criteria->order = 't.updated_date DESC';

        $criteria->mergeWith($criteria1);

        $dataProvider = new CActiveDataProvider('gPerson', [
                'criteria' => $criteria,
            ]
        );

        $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionIndex2()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (Yii::app()->user->name != "admin") {
            $criteria->with = ['company'];
            $criteria->addInCondition('company.company_id', sUser::model()->myGroupArray);
        }

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('address1',$_GET['gPerson']['address1'],true,'OR');
        }

        $criteria->order = 't.updated_date DESC';

        $criteria->mergeWith($criteria1);


        $this->render('index2', [
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
    public function loadModelPerformance($id)
    {
        $model = gTalentPerformance::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModelPotential($id)
    {
        $model = gTalentPotential::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelTargetSetting($id)
    {
        $model = gTalentTargetSetting::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelCoreCompetency($id)
    {
        $model = gTalentCoreCompetency::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelLeadershipCompetency($id)
    {
        $model = gTalentLeadershipCompetency::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelWorkResult($id)
    {
        $model = gTalentWorkResult::model()->findByPk($id);
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

    public function actionApproved($id)
    {
        $model = $this->loadModelTargetSetting($id);

        $model->validate_id = 2; //approved
        $model->save();

        return true;
    }


    public function actionCreatePotentialAjax($id, $year = 0)
    {
        $model = new gTalentPotential;

        if ($year == 0)
            $year = date('Y');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentPotential'])) {
            $model->attributes = $_POST['gTalentPotential'];
            $model->parent_id = (int)$id;
            $model->input_date = date('d-m-Y');
            $model->year = $year;

            if ($model->save()) {

                EQuickDlgs::checkDialogJsScript();

                $this->redirect(['view', 'id' => $id, 'tab' => 'Potential']);
            }
        }

        EQuickDlgs::render('_formPotential', ['model' => $model, 'year' => $year]);
    }

    public function actionCreateFinalRatingAjax($id, $year = 0)
    {
        $model = new gTalentPerformance;

        if ($year == 0)
            $year = date('Y');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gTalentPerformance'])) {
            $model->attributes = $_POST['gTalentPerformance'];
            $model->parent_id = (int)$id;
            $model->input_date = date('d-m-Y');

            if ($model->save()) {

                EQuickDlgs::checkDialogJsScript();

                $this->redirect(['view', 'id' => $id, 'tab' => 'Final Rating']);
            }
        }

        EQuickDlgs::render('_formFinalRating', ['model' => $model]);
    }

    public function actionPrintKpi($id, $year)
    {
        $pdf = new talentKpi('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $id);
        $criteria->compare('year', $year);
        $criteria->order = 'strategic_objective';

        $this->loadModel($id); //trap security

        $models = gTalentTargetSetting::model()->findAll($criteria);
        if ($models === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($models);

        $pdf->Output();
    }


    public function actionPrintCore($id, $year)
    {
        $pdf = new talentCore('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $id);
        $criteria->compare('year', $year);
        //$criteria->order = ' ';

        $this->loadModel($id); //trap security

        $models = gTalentCoreCompetency::model()->findAll($criteria);
        if ($models === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($models);

        $pdf->Output();
    }

    public function actionPrintLeadership($id, $year)
    {
        $pdf = new talentLeadership('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $id);
        $criteria->compare('year', $year);
        //$criteria->order = ' ';

        $this->loadModel($id); //trap security

        $models = gTalentLeadershipCompetency::model()->findAll($criteria);
        if ($models === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($models);

        $pdf->Output();
    }

    public function actionPrintFinalRating($id, $year)
    {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);

        $model = $this->loadModel($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $connection = Yii::app()->db;

        $sql = $this->finalResult($year);

        $sql.= " WHERE id = " . $id;

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();


        $pdf = new talentFinalRating('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $pdf->report($rows);

        $pdf->Output();
    }


    public function actionPrintCover($id, $year)
    {
        $pdf = new talentCover('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);

        $model = $this->loadModel($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model, $year);

        $pdf->Output();
    }

    public function actionReport()
    {
        $model = new fBeginEndDate('performance');

        if (isset($_POST['fBeginEndDate'])) {
            $model->attributes = $_POST['fBeginEndDate'];
            $model->company_id = sUser::model()->myGroup;
            if ($model->validate()) {

                spl_autoload_unregister(['YiiBase', 'autoload']);
                Yii::import('ext.phpexcel.Classes.PHPExcel', true);
                spl_autoload_register(['YiiBase', 'autoload']);

                $phpExcel = new PHPExcel();


                if ($model->report_id == 1) {
                    $this->report01($phpExcel, $model);
                } elseif ($model->report_id == 2) {
                    $this->report02($phpExcel, $model);
                }

            }
        }

        $this->render('report', ['model' => $model]);
    }

    private function report01($phpExcel, $model)
    {

        $criteria = new CDbCriteria;
        $criteria->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) = ' .
            $model->company_id . '
                AND (select c.level_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) = ' .
            $model->level_id;
        //$criteria->limit = 15;

        $dataProvider = new CActiveDataProvider('gPerson', [
            'criteria' => $criteria,
            'pagination' => false,
            'sort' => [
                //'defaultOrder'=>'year DESC',
            ]
        ]);

        $title = $dataProvider->getData();


        $styleBold = [
            'font' => [
                'bold' => true,
            ]
        ];

        $styleBackground = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => [
                    'rgb' => 'D8D8D8',
                ],
            ],
            'font' => [
                'name' => 'Arial',
                'size' => 12,
                'bold' => true,
            ],
        ];

        $foo = $phpExcel->getActiveSheet();

        $foo->setTitle("Performance");

        $foo->setCellValue("A1", "DATA PA KARYAWAN")->getStyle("A1:H1")->applyFromArray($styleBackground);
        $foo->mergeCells("A1:H1");
        $foo->getStyle("A1:H1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $foo->getRowDimension(1)->setRowHeight(22);
        $foo->getRowDimension(2)->setRowHeight(20);
        $foo->getColumnDimension("A")->setWidth(5);
        $foo->getColumnDimension("B")->setWidth(15);
        $foo->getColumnDimension("C")->setWidth(30);
        $foo->getColumnDimension("D")->setWidth(40);
        $foo->getColumnDimension("E")->setWidth(20);
        $foo->getColumnDimension("F")->setWidth(30);
        $foo->getColumnDimension("G")->setWidth(10);
        $foo->getColumnDimension("H")->setWidth(30);

        $foo->setCellValue("A2", "No")
            ->setCellValue("B2", "Photo")
            ->setCellValue("C2", "Basic Profile")
            ->setCellValue("D2", "Education")
            ->setCellValue("E2", "Work Experience")
            ->setCellValue("G2", "Performance Appraisal")
            ->getStyle("A2:H2")->applyFromArray($styleBold);

        $counter = 3;
        $current = 1;

        foreach ($dataProvider->getData() as $data) {
            $n0 = $counter;
            $n1 = $counter + 1;
            $n2 = $counter + 2;
            $n3 = $counter + 3;
            $n4 = $counter + 4;
            $n5 = $counter + 5;
            $n6 = $counter + 6;
            $n7 = $counter + 7;
            $n8 = $counter + 8;
            $n9 = $counter + 9;

            //Basic Profile
            $foo
                ->setCellValue("A$n0", $current)
                ->setCellValue("B$n0", $data->employee_name)
                ->mergeCells("B$n0:C$n0");

            $foo->getRowDimension($n0)->setRowHeight(18);

            $foo
                ->getStyle("A$n0:H$n0")
                ->applyFromArray($styleBackground);

            $foo
                ->setCellValue("B$n1", "PHOTO")
                ->setCellValue("C$n1", "Company: " . $data->mCompany())
                ->setCellValue("C$n2", "Department: " . $data->mDepartment())
                ->setCellValue("C$n3", "Job Title: " . $data->mJobTitle())
                ->setCellValue("C$n4", "Level: " . $data->mLevel())
                ->setCellValue("C$n5", "Status: " . ($data->countContract() != "") ? $data->mStatus() . " " . $data->countContract() : $data->mStatus())
                ->setCellValue("C$n6", "Join Date: " . (isset($data->companyfirst)) ? $data->companyfirst->start_date . " " . $data->countJoinDate() : "")
                ->setCellValue("C$n7", "Superior: " . $data->mSuperior())
                ->setCellValue("C$n8", "Birth Date: " . $data->birth_date)
                ->setCellValue("C$n9", "Length of Services: ");

            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('test_img');
            $objDrawing->setDescription('test_img');
            $objDrawing->setPath($data->photoPathReal);
            $objDrawing->setHeight(130);
            $objDrawing->setCoordinates("B$n1");
            $objDrawing->setWorksheet($foo);

            //Education
            foreach ($data->many_education as $key => $dataEdu) {
                if ($dataEdu->level_id >= 8) {
                    $foo
                        ->setCellValue("D$n1", $dataEdu->edulevel->name . " " . $dataEdu->interest)
                        ->setCellValue("D$n2", $dataEdu->school_name . ", " . $dataEdu->graduate . ". GPA: " . $dataEdu->ipk);
                }
            }

            //Experience
            foreach ($data->many_experience as $key => $dataExp) {
                if ($key <= 5) {
                    $foo
                        ->setCellValue("E$n1", $dataExp->start_date . " to " . $dataExp->end_date)
                        ->setCellValue("F$n1", $dataExp->job_title . " at " . $dataExp->company_name);
                }
            }
            //Performance
            foreach ($data->performance as $key => $perf) {
                $foo
                    ->setCellValue("G$n1", "PA " . $perf->year . ' = ' . $perf->pa_value . ' , ' . $perf->potential);
            }

            $counter = $n9 + 2;
            $current++;
        }

        $phpExcel->setActiveSheetIndex(0);

        //Output the generated excel file so that the user can save or open the file.
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"performance_" . date('Ymd') . ".xls\"");

        header("Cache-Control: max-age=0");

        $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
        $objWriter->save("php://output");
    }

    private function report02($phpExcel, $model)
    {

        $connection = Yii::app()->db;

        $sql = $this->finalResult($model->year);

        $sql.= " WHERE 
        (select `o`.`id` AS `id` from (`g_person_career` `c` left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
            where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
            order by `c`.`start_date` desc limit 1) = " . $model->company_id;

        if ($model->level_id != 0) {
            $sql.= " AND
            (select `s`.`level_id` from `g_person_career` `s` 
                where `s`.`parent_id` = `a`.`id` order by `s`.`start_date` desc limit 1) = " . $model->level_id . "
            ";
        }

        $sql.= " ORDER BY  (select `s`.`level_id` from `g_person_career` `s` 
            where `s`.`parent_id` = `a`.`id` order by `s`.`start_date` desc limit 1)  ";

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();


        $styleBold = [
            'font' => [
                'bold' => true,
            ]
        ];

        $styleBackground = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => [
                    'rgb' => 'D8D8D8',
                ],
            ],
            'font' => [
                'name' => 'Arial',
                'size' => 12,
                'bold' => true,
            ],
        ];

        $foo = $phpExcel->getActiveSheet();

        $foo->setTitle("Performance Apraisal");

        $foo->setCellValue("A1", "REKAPITULASI PERFORMANCE APPRAISAL")->getStyle("A1:H1")->applyFromArray($styleBackground);
        $foo->mergeCells("A1:M1");
        $foo->getStyle("A1:M1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $foo->getRowDimension(1)->setRowHeight(22);
        $foo->getRowDimension(2)->setRowHeight(20);
        $foo->getColumnDimension("A")->setWidth(5);
        $foo->getColumnDimension("B")->setWidth(30);
        $foo->getColumnDimension("C")->setWidth(20);
        $foo->getColumnDimension("D")->setWidth(20);
        $foo->getColumnDimension("E")->setWidth(10);
        $foo->getColumnDimension("F")->setWidth(20);
        $foo->getColumnDimension("G")->setWidth(10);
        $foo->getColumnDimension("H")->setWidth(10);
        $foo->getColumnDimension("I")->setWidth(10);
        $foo->getColumnDimension("J")->setWidth(10);
        $foo->getColumnDimension("K")->setWidth(10);
        $foo->getColumnDimension("L")->setWidth(10);
        $foo->getColumnDimension("M")->setWidth(10);

        $foo->setCellValue("A2", "No")
            ->setCellValue("B2", "Nama")
            ->setCellValue("C2", "Direktorat")
            ->setCellValue("D2", "Pangkat")
            ->setCellValue("E2", "Tgl. Mulai Kerja")
            ->setCellValue("F2", "Masa Kerja")
            ->setCellValue("G2", "KPI")
            ->setCellValue("H2", "Kompetensi Diri")
            ->setCellValue("I2", "Kompetensi Kepemimpinan")
            ->setCellValue("J2", "Total Nilai")
            ->setCellValue("K2", "Rating")
            ->setCellValue("L2", "Final Rating")
            ->setCellValue("M2", "Potensial")
            ->getStyle("A2:M2")->applyFromArray($styleBold);

        $n0 = 3;

        foreach ($rows as $row) {

            if ($row['level_id'] >= 10) {
                if ($model->period == 1) {
                    $kpi_workresult = $row['kpi1'];
                    $core = $row['core1'];
                    $leadership = $row['leadership1'];
                    $total = $kpi_workresult + $core + $leadership;
                } else {
                    $kpi_workresult = $row['kpi2'];
                    $core = $row['core2'];
                    $leadership = $row['leadership2'];
                    $total = $kpi_workresult + $core + $leadership;
                }
            } else {
                $kpi_workresult = $row['work_result'];
                $core = $row['core2'];
                if ($row['level_id'] > 6) {
                    $leadership = $row['leadership2'];
                } else
                    $leadership = 0;
                $total = $kpi_workresult + $core + $leadership;
            }

            $foo
                ->setCellValue("A$n0", $n0 - 2)
                ->setCellValue("B$n0", $row['employee_name'])
                ->setCellValue("C$n0", $row['department'])
                ->setCellValue("D$n0", $row['level'])
                ->setCellValue("E$n0", date("d-m-Y", strtotime($row['join_date'])))
                ->setCellValue("F$n0", $row['count_join_date'])
                ->setCellValue("G$n0", $kpi_workresult)
                ->setCellValue("H$n0", $core)
                ->setCellValue("I$n0", $leadership)
                ->setCellValue("J$n0", $total);


            $n0++;
        }
    }

    public function finalResult($year)
    {

        $sql = "
        SELECT a.id, a.employee_name, 
        (select `o`.`name` AS `name` from (`g_person_career` `c` left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
            where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15))) order by `c`.`start_date` desc limit 1) 
            AS `company`,

        (select `o`.`name` AS `name` from (`g_person_career` `c` left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
            where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15))) order by `c`.`start_date` desc limit 1) 
            AS `department`,

        (select `s`.`job_title` AS `job_title` from `g_person_career` `s`
            where `s`.`parent_id` = `a`.`id` order by `s`.`start_date` desc limit 1) 
            AS `job_title`,

        (select `o`.`name` AS `name` from (`g_person_career` `s` left join `g_param_level` `o` ON ((`o`.`id` = `s`.`level_id`)))
            where (`s`.`parent_id` = `a`.`id`) order by `s`.`start_date` desc limit 1) 
            AS `level`,

        (select `s`.`level_id` AS `level_id` from `g_person_career` `s`
            where `s`.`parent_id` = `a`.`id` order by `s`.`start_date` desc limit 1) 
            AS `level_id`,

        (select `o`.`golongan` AS `golongan` from (`g_person_career` `s` left join `g_param_level` `o` ON ((`o`.`id` = `s`.`level_id`)))
            where (`s`.`parent_id` = `a`.`id`) order by `s`.`start_date` desc limit 1) 
            AS `golongan`,

        (select `c`.`start_date` AS `start_date` from `g_person_career` `c` where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` = 1))
            order by `c`.`start_date` desc limit 1) 
            AS `join_date`,

        CONCAT ( TIMESTAMPDIFF(YEAR,(select `c`.`start_date` AS `start_date` from `g_person_career` `c` where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` = 1))
            order by `c`.`start_date` desc limit 1),CURDATE()) , ' Thn ',
            MOD(TIMESTAMPDIFF(MONTH, (select `c`.`start_date` AS `start_date` from `g_person_career` `c` where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` = 1))
            order by `c`.`start_date` desc limit 1),CURDATE()),12) , ' Bln' )
            AS `count_join_date`,
        ".$year." as year,

        (SELECT sum(ts.superior_score * ts.weight) as total FROM g_talent_target_setting ts WHERE ts.parent_id = a.id AND ts.year = " . $year . ") as kpi1,
        (SELECT sum(ts.superior2_score * ts.weight) as total FROM g_talent_target_setting ts WHERE ts.parent_id = a.id AND ts.year = " . $year . ") as kpi2,
        (SELECT sum(cc.superior_score * pp.weight) as total FROM g_talent_work_result cc 
            INNER JOIN g_param_competency pp ON pp.id = cc.talent_template_id WHERE cc.parent_id = a.id AND cc.year = " . $year . ") as work_result,


        (SELECT sum(cc.superior_score * pp.weight) as total FROM g_talent_core_competency cc 
            INNER JOIN g_param_competency pp ON pp.id = cc.talent_template_id WHERE cc.parent_id = a.id AND cc.year = " . $year . ") as core1,
        (SELECT sum(cc.superior2_score * pp.weight) as total FROM g_talent_core_competency cc 
            INNER JOIN g_param_competency pp ON pp.id = cc.talent_template_id WHERE cc.parent_id = a.id AND cc.year = " . $year . ") as core2,

        (SELECT sum(ll.superior_score * pp.weight) as total FROM g_talent_leadership_competency ll
            INNER JOIN g_param_competency pp ON pp.id = ll.talent_template_id WHERE ll.parent_id = a.id AND ll.year = " . $year . ") as leadership1,
        (SELECT sum(ll.superior2_score * pp.weight) as total FROM g_talent_leadership_competency ll
            INNER JOIN g_param_competency pp ON pp.id = ll.talent_template_id WHERE ll.parent_id = a.id AND ll.year = " . $year . ") as leadership2,

        (SELECT sum(ts.superior2_score * ts.weight) as total FROM g_talent_target_setting ts WHERE ts.parent_id = a.id AND ts.year = " . $year . ") +
        (SELECT sum(cc.superior2_score * pp.weight) as total FROM g_talent_core_competency cc 
            INNER JOIN g_param_competency pp ON pp.id = cc.talent_template_id WHERE cc.parent_id = a.id AND cc.year = " . $year . ") +
        (SELECT sum(ll.superior2_score * pp.weight) as total FROM g_talent_leadership_competency ll
            INNER JOIN g_param_competency pp ON pp.id = ll.talent_template_id WHERE ll.parent_id = a.id AND ll.year = " . $year . ") as t_total,

        (SELECT cp.pa_value  as total FROM g_talent_performance cp WHERE cp.period_id = 1 AND cp.parent_id = a.id AND cp.year = " . $year . " ) as final1,
        (SELECT cp.pa_value  as total FROM g_talent_performance cp WHERE cp.period_id = 2 AND cp.parent_id = a.id AND cp.year = " . $year . " ) as final2

        FROM g_person a ";

        return $sql;
    }

}
