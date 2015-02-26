<?php

class GPersonCostcenterController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
            'ajaxOnly + PersonAutoComplete,PersonAutoCompleteId,PersonAutoCompleteIdAdmin,
				CreateStatusAjax',
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $modelCostcenter = $this->newCostcenter($model->id);

        $this->render('view', [
            'model' => $model,
            'modelCostcenter' => $modelCostcenter,
        ]);
    }

    public function actionDeleteCostcenter($id)
    {
        $this->loadModelCostcenter($id)->delete();
    }


    public function newCostcenter($id)
    {
        $model = new gPersonCostcenter;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonCostcenter'])) {
            $model->attributes = $_POST['gPersonCostcenter'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'tab' => 'Cost Center']);
        }

        return $model;
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->layout = '//layouts/column3filter';

        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;

        /* if (Yii::app()->user->name != "admin") {
          $criteria2 = new CDbCriteria;
          $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
          implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
          ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
          implode(",", sUser::model()->myGroupArray) . ') OR ' .
          '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
          implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
          implode(",", sUser::model()->myGroupArray) . ')';
          $criteria->mergeWith($criteria2);
          } */

        if (isset($_GET['pid']) && ($_GET['pid'] != null)) {
            $criteria->condition = '(select c.department_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) = ' . $_GET['pid'];
        }

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1 = new CDbCriteria;
            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('address1',$_GET['gPerson']['address1'],true,'OR');
            $criteria->mergeWith($criteria1);
        }

        $criteria->order = 'updated_date DESC';

        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM g_person');

        //$dataProvider=new CActiveDataProvider('gPerson', array(
        $dataProvider = new CActiveDataProvider(gPerson::model()->cache(3600, $dependency, 2), [
                'criteria' => $criteria,
            ]
        );

        //Yii::app()->user->setFlash('info','<strong>Upload Photo!</strong> Upload Photo yang tadinya bermasalah sekarang sudah bisa digunakan.. ');

        $this->render('index', [
            'dataProvider' => $dataProvider,
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

        /* if (Yii::app()->user->name != "admin") {
          $criteria->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
          implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
          ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
          implode(",", sUser::model()->myGroupArray) . ') OR ' .
          '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
          implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
          implode(",", sUser::model()->myGroupArray) . ')';
          } */

        $model = gPerson::model()->findByPk((int)$id, $criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelCostcenter($id)
    {
        $criteria = new CDbCriteria;

        $model = gPersonCostcenter::model()->findByPk((int)$id, $criteria);
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

    public function actionPersonAutoComplete()
    {


        $res = [];
        if (isset($_GET['term'])) {
            /* if (Yii::app()->user->name != "admin") {
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
              } else { */
            $qtxt = "SELECT DISTINCT a.employee_name FROM g_person a
			WHERE a.employee_name LIKE :name
			ORDER BY a.employee_name LIMIT 20";
            //}
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryColumn();
            //$res =$command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionPersonAutoCompleteId()
    {
        $res = [];
        if (isset($_GET['term'])) {
            /* if (Yii::app()->user->name != "admin") {
              $qtxt = 'SELECT CONCAT(a.employee_name," (",a.employee_code_global,")") as label, a.id as id FROM g_person a
              WHERE a.employee_name LIKE :name AND ' .
              '((select c.company_id from g_person_career c WHERE a.id=c.parent_id AND c.status_id IN (' .
              implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
              ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
              implode(",", sUser::model()->myGroupArray) . ') OR ' .
              '(select c2.company_id from g_person_career2 c2 WHERE a.id=c2.parent_id AND c2.company_id IN (' .
              implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
              implode(",", sUser::model()->myGroupArray) . ')) ' .
              'ORDER BY a.employee_name LIMIT 20';
              } else { */
            $qtxt = "SELECT CONCAT(employee_name,' (',employee_code,')') as label, id FROM g_person 
			WHERE employee_name LIKE :name 
			ORDER BY employee_name LIMIT 20";
            //}
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionPersonAutoCompletePhoto()
    {
        $res = [];
        if (isset($_GET['term'])) {
            /* if (Yii::app()->user->name != "admin") {
              $qtxt = 'SELECT a.employee_name as label, c_pathfoto as photo, a.id as id FROM g_person a
              WHERE a.employee_name LIKE :name AND' .
              '((select c.company_id from g_person_career c WHERE a.id=c.parent_id AND c.status_id IN (' .
              implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
              ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
              implode(",", sUser::model()->myGroupArray) . ') OR ' .
              '(select c2.company_id from g_person_career2 c2 WHERE a.id=c2.parent_id AND c2.company_id IN (' .
              implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
              implode(",", sUser::model()->myGroupArray) . ')) ' .
              'ORDER BY a.employee_name LIMIT 20';
              } else { */
            $qtxt = "SELECT employee_name as label, c_pathfoto as photo, id FROM g_person 
			WHERE employee_name LIKE :name 
			ORDER BY employee_name LIMIT 20";
            //}
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionPersonAutoCompleteIdAdmin()
    {
        $res = [];
        if (isset($_GET['term'])) {
            $qtxt = "SELECT CONCAT(employee_name,' (',employee_code_global,')') as label, id FROM g_person 
			WHERE employee_name LIKE :name 
			ORDER BY employee_name LIMIT 20";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionPrintProfile($id)
    {
        $pdf = new profile('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        //$model=gPerson::model()->findByPk((int)$id);
        $pdf->report($id);

        $pdf->Output();
    }

    public function actionCreateAssignmentAjax($id)
    {
        $model = new gPersonCareer2;

        if (isset($_POST['gPersonCareer2'])) {
            $model->attributes = $_POST['gPersonCareer2'];
            $model->parent_id = (int)$id;

            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
                $this->redirect(['view', 'id' => $id, 'tab' => 'Assignment']);
            }
        }

        EQuickDlgs::render('_formCareer2', ['model' => $model]);
    }

}
