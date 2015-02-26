<?php

class TClosingController extends Controller
{

    public $layout = '//layouts/column1';

    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function actionIndex()
    {
        $this->render('/tPosting/closing', [
        ]);
    }

    public function actionClosingPeriodExecution()
    {

        $_curPeriod = Yii::app()->params["cCurrentPeriod"];
        $_lastPeriod = peterFunc::cBeginDateBefore(Yii::app()->params["cCurrentPeriod"]);

        $_nextPeriod = peterFunc::cBeginDateAfter(Yii::app()->params["cCurrentPeriod"]);
        Yii::app()->settings->set("System", "cCurrentPeriod", $_nextPeriod, $toDatabase = true);

        Yii::app()->user->setFlash('success', '<strong>Great!</strong> Closing Period has been successful...');

        $this->redirect(['index']);
        //return true;
    }

    public function actionClosingPeriodExecutionB()
    {

        $_curPeriod = Yii::app()->params["cCurrentPeriod"];
        $_lastPeriod = peterFunc::cBeginDateBefore(Yii::app()->params["cCurrentPeriod"]);

        $_nextPeriod = peterFunc::cBeginDateAfter(Yii::app()->params["cCurrentPeriod"]);
        Yii::app()->settings->set("System", "cCurrentPeriod", $_lastPeriod, $toDatabase = true);

        Yii::app()->user->setFlash('success', '<strong>Great!</strong> Closing Period has been successful...');

        $this->redirect(['index']);
        //return true;
    }

}
