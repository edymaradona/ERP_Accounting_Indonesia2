<?php

class sCompanyNewsPromotionController extends Controller
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
            'rights', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        if (Yii::app()->user->isGuest) {
            $this->layout = '//layouts/mainGuest';
        }
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
        $model = new sCompanyNews;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sCompanyNews'])) {
            $model->attributes = $_POST['sCompanyNews'];
            if ($model->save())
                $this->redirect(['view', 'id' => $model->id]);
        }
        //if (!isset($model->content))
        //    $model->content = "::<i>write or paste your article here::</i>";

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
        if (isset($_POST['sCompanyNews'])) {
            $model->attributes = $_POST['sCompanyNews'];
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
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new sCompanyNews('search');
        if (isset($_GET['sCompanyNews']))
            $model->attributes = $_GET['sCompanyNews'];
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
        $criteria = new CDbCriteria;
        $criteria->with = ['created'];
        $criteria->together = true;
        $criteria->compare('created.default_group', sUser::getMyGroup());
        $model = sCompanyNews::model()->findByPk($id, $criteria);
        if ($model === null)
            throw new CHttpException(404, 'You are not authorized to execute this command. Different Business Unit Creator');
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
