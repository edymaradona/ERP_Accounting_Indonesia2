<?php

class MenuController extends Controller
{

    public $layout = '//layouts/main';

    //public $pageTitle = Yii::app()->name . ' - Menu';

    public function init()
    {
        //Yii::app()->language='id';
        //return parent::init();
        //Yii::import('ext.LanguagePicker.ELanguagePicker');
        //ELanguagePicker::setLanguage();
        //return parent::init();
    }

    public function actions()
    {
        return [
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => [
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ],
        ];
    }

    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function actionIndex()
    {
        if (!Yii::app()->user->isGuest) {
            $this->render('index', [
            ]);
        } else
            $this->redirect(['site/login']);
    }


    public function actionCalendarEvents()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('category_id', 7);
        $models = sCompanyNews::model()->findAll($criteria);
        $items = [];
        $detail = [];
        $input = ["#CC0000", "#0000CC", "#333333", "#663333", "#993333", "#CC3333", "#003366", "#663366", "#993366", "#CC3366", "#6633CC"];
        foreach ($models as $model) {
            $detail['title'] = $model->title;
            //$detail['start']= date('Y').'-'.date('m',strtotime($model->publish_date)).'-'.date('d',strtotime($model->publish_date));
            $detail['start'] = date('Y-m-d', strtotime($model->publish_date));
            $detail['color'] = $input[rand(0, 10)];
            $detail['allDay'] = true;
            $detail['url'] = Yii::app()->createUrl('sCompanyNews/view', ["id" => $model->id]);
            $items[] = $detail;
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

}
