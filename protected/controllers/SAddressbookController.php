<?php

class SAddressbookController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout = '//layouts/column2';
    public $layout = '//layouts/column2left';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        ];
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return [
            ['allow', // allow all users to perform 'index' and 'view' actions
                'users' => ['admin'],
            ],
            ['deny', // deny all users
                'users' => ['*'],
            ],
        ];
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new sAddressbook;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sAddressbook'])) {
            $model->attributes = $_POST['sAddressbook'];
            if ($model->save())
                $this->redirect(['index']);
        }
        $this->render('create', [
            'model' => $model,
        ]);
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
        if (isset($_POST['sAddressbook'])) {
            $model->attributes = $_POST['sAddressbook'];
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

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new sAddressbook('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['sAddressbook']))
            $model->attributes = $_GET['sAddressbook'];
        $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Manages all models.
     */
    public function actionGroup()
    {
        $model = new sAddressbookGroup('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['sAddressbookGroup']))
            $model->attributes = $_GET['sAddressbookGroup'];
        $this->render('group', [
            'model' => $model,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return sAddressbook the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = sAddressbook::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param sAddressbook $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 's-addressbook-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    ///GROUP
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionViewGroup($id)
    {
        $this->render('viewGroup', [
            'model' => $this->loadModelGroup($id),
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateGroup()
    {
        $model = new sAddressbookGroup;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sAddressbookGroup'])) {
            $model->attributes = $_POST['sAddressbookGroup'];
            if ($model->save())
                $this->redirect(['group']);
        }
        $this->render('createGroup', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateGroup($id)
    {
        $model = $this->loadModelGroup($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sAddressbookGroup'])) {
            $model->attributes = $_POST['sAddressbookGroup'];
            if ($model->save())
                $this->redirect(['view', 'id' => $model->id]);
        }
        $this->render('updateGroup', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeleteGroup($id)
    {
        $this->loadModelGroup($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return sAddressbookGroup the loaded model
     * @throws CHttpException
     */
    public function loadModelGroup($id)
    {
        $model = sAddressbookGroup::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
