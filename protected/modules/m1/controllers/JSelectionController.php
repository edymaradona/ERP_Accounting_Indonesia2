<?php

class JSelectionController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';
    public $layout = '//layouts/column2leftW';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'rights', // perform access control for CRUD operations
            'postOnly + delete, deptUpdate', // we only allow deletion via POST request
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $newParticipant = $this->newParticipant($id);

        $this->render('view', [
            'model' => $this->loadModel($id),
            'modelParticipant' => $newParticipant,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newParticipant($id)
    {
        $model = new jSelectionPart;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['jSelectionPart'])) {
            $model->attributes = $_POST['jSelectionPart'];
            $model->parent_id = (int)$id;
            $model->flow_id = 1; //Applied, New Entry
            if ($model->save())
                $this->redirect(['view', 'id' => $id]);
        }

        return $model;
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->render('index', [
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = jSelection::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'j-selection-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCalendarEvents()
    {
        $criteria = new CDbCriteria;
        //$criteria->compare('company_id', sUser::model()->myGroup);

        $models = jSelection::model()->findAll($criteria);

        $items = [];
        $detail = [];
        $input = ["#CC0000", "#0000CC", "#333333", "#663333", "#993333", "#CC3333", "#003366", "#663366", "#993366", "#CC3366", "#6633CC"];
        foreach ($models as $model) {
            $detail['title'] = $model->category->name . " (" . $model->partCount . ")";
            $detail['start'] = date('Y-m-d', strtotime($model->schedule_date));
            $detail['color'] = ($model->category_id == 1) ? $input[0] : $input[1];
            $detail['allDay'] = true;
            $detail['url'] = Yii::app()->createUrl('/m1/jSelection/view', ["id" => $model->id]);
            $items[] = $detail;
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionEmployeeAutoCompletePhoto()
    {
        $res = [];
        if (isset($_GET['term'])) {
            if (Yii::app()->user->name != "admin") {
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
            } else {
                $qtxt = "SELECT employee_name as label, c_pathfoto as photo, id FROM g_person 
			WHERE employee_name LIKE :name 
			ORDER BY employee_name LIMIT 20";
            }
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
            $qtxt = "SELECT applicant_name as label, c_pathfoto as photo, id, 
			CONCAT(DATE_FORMAT(birth_date,'%d-%m-%Y'),' ; ',left(address1,30)) as detail 
			FROM h_applicant 
			WHERE applicant_name LIKE :name 
			ORDER BY updated_date DESC, applicant_name LIMIT 20";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function loadModelPart($id)
    {
        $model = jSelectionPart::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function actionDeptUpdate()
    {
        $cat_id = $_POST['jSelectionPart']['company_id'];
        $models = aOrganization::model()->findAll(['condition' => 'parent_id = ' . $cat_id, 'order' => 'id']);

        foreach ($models as $model) {
            foreach ($model->childs as $mod)
                foreach ($mod->childs as $m)
                    //$_items[$m->getparent->getparent->name ." - ". $m->getparent->name][$m->id]=$m->name;
                    $_items[$m->id] = $m->name;
        }

        //$data=CHtml::listData($models,'id','name');

        foreach ($_items as $value => $dept) {
            echo CHtml::tag('option', ['value' => $value], CHtml::encode($dept), true);
        }
    }

}
