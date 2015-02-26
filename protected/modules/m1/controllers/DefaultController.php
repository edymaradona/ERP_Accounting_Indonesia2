<?php

class DefaultController extends Controller
{

    //public $layout='//layouts/column2';
    public $layout = '//layouts/main';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function actionIndex()
    {
        //$this->layout='//layouts/column1';
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;

        if (Yii::app()->user->name != "admin") {
            $criteria2 = new CDbCriteria;
            $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
                implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                implode(",", sUser::model()->myGroupArray) . ') OR ' .
                '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
                implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria2);
        }

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

        //Yii::app()->user->setFlash('info', '<strong>Important!</strong> Superior Name NOW is a part of uncomplete calculation');

        $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionCompByProfile()
    {
        $this->render('compByProfile');
    }

    public function actionCompByCareer()
    {
        $this->render('compByCareer');
    }

    public function actionCompByDepartment()
    {
        $this->render('compByDepartment');
    }

    public function actionBirthday()
    {
        $this->render('birthday');
    }

    public function actionProbationcontract()
    {
        $this->render('probationcontract');
    }

    public function actionEmployeeinout()
    {
        $this->render('employeeinout');
    }

    public function actionBlacklist()
    {
        $this->render('blacklist');
    }

    public function actionUncomplete()
    {
        $this->render('uncomplete', [
        ]);
    }

    public function actionCalendarEvents()
    {
        $criteria = new CDbCriteria;
        /* $criteria->condition = "
          date(CONCAT(year(now()),'-',month(birth_date),'-',day(birth_date)))
          BETWEEN date(CONCAT(year(curdate()),'-',month(curdate()),'-01')) AND
          DATE_ADD(date(CONCAT(year(curdate()),'-',month(curdate()),'-01')),INTERVAL 1 MONTH)-1
          OR
          date(CONCAT(year(now()),'-',month(birth_date),'-',day(birth_date)))
          BETWEEN DATE_ADD(date(CONCAT(year(curdate()),'-',month(curdate()),'-01')),INTERVAL 1 MONTH) AND
          DATE_ADD(date(CONCAT(year(curdate()),'-',month(curdate()),'-01')),INTERVAL 2 MONTH)-1
          "; */


        $criteria->order = " date(CONCAT(year(now()),'-',month(birth_date),'-',day(birth_date)))";


        $criteria3 = new CDbCriteria; //8=RESIGN, 9=TERMINATION, 10=End Of Contract
        //$criteria3->condition = '(select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) NOT IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ')';
        $criteria3->condition = '
            (select s.status_id from g_person_status s WHERE t.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
			(' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
            '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')
        ';
        $criteria->mergeWith($criteria3);


        $models = gPerson::model()->findAll($criteria);

        $items = [];
        $detail = [];
        foreach ($models as $model) {
            $detail['title'] = $model->employee_name;
            $detail['start'] = strtotime(date('Y') . '-' . date('m', strtotime($model->birth_date)) . '-' . date('d', strtotime($model->birth_date)));
            $detail['color'] = '#CC0000';
            $detail['allDay'] = true;
            $detail['url'] = Yii::app()->createUrl('/m1/gPerson/view', ["id" => $model->id]);
            $items[] = $detail;
        }

        echo CJSON::encode($items);
        Yii::app()->end();
    }

}
