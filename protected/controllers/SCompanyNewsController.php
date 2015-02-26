<?php

class sCompanyNewsController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    public function actions(){
        return array(
            'search'=>array(
                            'class'=>'ext.esearch.SearchAction',
                            'model'=>'sCompanyNews',
                            'attributes'=>array('title', 'content'),
                        )
        );
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        //if (Yii::app()->user->isGuest) {
        //		$this->layout='//layouts/mainGuest';
        $this->render('view', [
            'model' => $this->loadModel($id),
        ]);
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new sCompanyNews('search');
        $model->unsetAttributes();
        $criteria = new CDbCriteria;
        $criteria->scopes = ['app_publish', 'noQuote_Announcement', 'recently'];
        if (isset($_GET['sCompanyNews'])) {
            $model->attributes = $_GET['sCompanyNews'];
            $criteria1 = new CDbCriteria;
            $criteria1->compare('title', $_GET['sCompanyNews']['title'], true, 'OR');
            $criteria1->compare('content', $_GET['sCompanyNews']['title'], true, 'OR');
            $criteria->mergeWith($criteria1);
        }
        $dataProvider = new CActiveDataProvider('sCompanyNews', [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
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
        if (Yii::app()->user->isGuest) {
            $criteria->scopes = ['app_publish', 'noQuote_Announcement'];
        } else
            $criteria->scopes = ['app_publish', 'noQuote_Announcement_WithCalendar'];
        $model = sCompanyNews::model()->findByPk((int)$id, $criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'scompany-news-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
