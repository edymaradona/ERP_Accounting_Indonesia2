<?php

class ILearningController extends Controller
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
            //'ajaxOnly + calendarEvents,PersonAutoComplete, PersonAutoCompletePhoto ',
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionViewDetail($id)
    {
        $newParticipant = $this->newParticipant($id);

        $this->render('viewDetail', [
            'model' => $this->loadModelSchedule($id),
            'modelParticipant' => $newParticipant,
        ]);
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

                $this->newInbox([
                    'recipient' => $model->employee->userid,
                    'subject' => "Learning schedule has been set for you",
                    'message' => "Dear " . $model->employee->employee_name . ",<br/><br/> 
					Your name has been added to following training: " . $model->getparent->getparent->learning_title . " that will be held on: 
					" .
                        CHtml::link($model->getparent->schedule_date, Yii::app()->createUrl(Yii::app()->request->HostInfo . '/m1/gEss/viewDetailEss', ['id' => $model->parent_id]))
                        . ".<br/><br/>
					Dont forget! and see you there. Thank You very much... <br/><br/>"
                ]);

                $this->redirect(['viewDetail', 'id' => $id]);
            }
        }

        return $model;
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
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->render('index', [
        ]);
    }

    public function actionPersonAutoComplete()
    {
        $res = [];
        if (isset($_GET['term'])) {
            if (Yii::app()->user->name != "admin") {
                //$qtxt ="SELECT employee_name as label, id FROM g_person WHERE employee_name LIKE :name ORDER BY employee_name LIMIT 20";
                $qtxt = "SELECT DISTINCT a.employee_name FROM g_person a
			WHERE a.employee_name LIKE :name AND
			(select b.company_id from g_person_career b where b.parent_id = a.id AND b.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by b.start_date DESC limit 1) IN (" . implode(",", sUser::model()->myGroupArray) . ")
			ORDER BY a.employee_name LIMIT 20";
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

    public function actionPersonAutoCompletePhoto()
    {
        $res = [];
        if (isset($_GET['term'])) {
            $qtxt = "SELECT a.employee_name as label, c_pathfoto as photo, a.id as id, 
			        concat(convert( left((select 
                            `c`.`start_date` AS `start_date`
                        from
                            `g_person_career` `c`
                        where
                            ((`a`.`id` = `c`.`parent_id`)
                                and (`c`.`status_id` = 1))
                        order by `c`.`start_date` desc
                        limit 1),
                    4) using latin1),
                `a`.`employee_code_global`) AS `company` FROM g_person a
			WHERE a.employee_name LIKE :name AND
			(select b.company_id from g_person_career b where b.parent_id = a.id AND b.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by b.start_date DESC limit 1) IN (" . implode(",", sUser::model()->myGroupArray) . ")
			AND  (select `s`.`status_id` AS `status_id` from `g_person_status` `s` where `s`.`parent_id` = `a`.`id` order by `s`.`start_date` desc limit 1) NOT IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ") 
			ORDER BY a.employee_name LIMIT 20";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
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
            $detail['title'] = $model->learning_status . " (" . $model->partCount . ")";
            //$detail['title'] = $model->learning_status;
            $detail['start'] = date('Y') . '-' . date('m', strtotime($model->schedule_date)) . '-' . date('d', strtotime($model->schedule_date));
            //$detail['start']= $model->schedule_date;
            $detail['color'] = $input[rand(0, 10)];
            $detail['allDay'] = true;
            $detail['url'] = Yii::app()->createUrl('/m1/iLearning/viewDetail', ["id" => $model->id]);
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
        $dataProvider = new CActiveDataProvider('iLearning', [
            'criteria' => [
                'order' => 'learning_title',
            ]
        ]);
        $this->render('index2', [
            'dataProvider' => $dataProvider,
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

    public function actionReport()
    {
        $this->render('report');
    }

    public function actionReport2()
    {
        $pdf = new learning2('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $pdf->report();

        $pdf->Output();
    }

    public function actionReport3()
    {
        $pdf = new learning3('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $pdf->report();

        $pdf->Output();
    }

    public function actionCreateParticipantAjax($id)
    {

        $model = new iLearningSchPart;
        if (isset($_POST['iLearningSchPart'])) {
            $model->attributes = $_POST['iLearningSchPart'];
            $model->parent_id = (int)$id;
            $model->flow_id = 1; //Applied, New Entry
            if ($model->save()) {
                $this->newInbox([
                    'recipient' => $model->employee->userid,
                    'subject' => "Learning schedule has been set for you",
                    'message' => "Dear " . $model->employee->employee_name . ",<br/><br/> 
                    Your name has been added to following training: " . $model->getparent->getparent->learning_title . " that will be held on: 
                    " .
                        CHtml::link($model->getparent->schedule_date, Yii::app()->createUrl(Yii::app()->request->HostInfo . '/m1/gEss/viewDetailEss', ['id' => $model->parent_id]))
                        . ".<br/><br/>
                    Dont forget! and see you there. Thank You very much... <br/><br/>"
                ]);
                return true;
            }
        }

        return false;

    }

}
