<?php

class SHelpController extends Controller
{

    public $layout = '//layouts/column1help';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return [
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => [
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ],
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => [
                'class' => 'CViewAction',
                'viewParam' => 'to',
            ],
            //'link'=>array(
            //	'class'=>'CViewAction',
            //),
        ];
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {

        $this->render('index', [
        ]);
    }

}
