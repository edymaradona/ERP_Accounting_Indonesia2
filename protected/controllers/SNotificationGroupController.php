<?php

class SNotificationGroupController extends Controller
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
            'rights',
            //'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $modelNotificationGroupMember = $this->newNotificationGroupMember($id);
        $this->render('view', [
            'model' => $this->loadModel($id),
            'modelNotificationGroupMember' => $modelNotificationGroupMember,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new sNotificationGroup;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sNotificationGroup'])) {
            $model->attributes = $_POST['sNotificationGroup'];
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
    public function newNotificationGroupMember($id)
    {
        $model = new sNotificationGroupMember;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sNotificationGroupMember'])) {
            $model->attributes = $_POST['sNotificationGroupMember'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->refresh();
        }
        return $model;
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sNotificationGroup'])) {
            $model->attributes = $_POST['sNotificationGroup'];
            if ($model->save())
                $this->redirect(['view', 'id' => $model->id]);
        }
        $this->render('update', [
            'model' => $model,
        ]);
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
    }

    public function actionDeleteNotificationGroupMember($id)
    {
        $this->loadModelNotificationGroupMember($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new sNotificationGroup('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['sNotificationGroup']))
            $model->attributes = $_GET['sNotificationGroup'];
        $this->render('index', [
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
        $model = sNotificationGroup::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelNotificationGroupMember($id)
    {
        $model = sNotificationGroupMember::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 's-notification-group-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
