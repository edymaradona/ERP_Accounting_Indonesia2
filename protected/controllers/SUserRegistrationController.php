<?php

class SUserRegistrationController extends Controller
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
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return [
            ['allow', // allow admin user to perform 'admin' and 'delete' actions
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
        $model = new sUserRegistration;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sUserRegistration'])) {
            $model->attributes = $_POST['sUserRegistration'];
            if ($model->save())
                $this->redirect(['view', 'id' => $model->id]);
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
        if (isset($_POST['sUserRegistration'])) {
            $model->attributes = $_POST['sUserRegistration'];
            if ($model->save())
                $this->redirect(['view', 'id' => $model->id]);
        }
        $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdatePassword($id)
    {
        $model = $this->loadModel($id);
        //$model->setScenario('registration');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sUserRegistration'])) {
            $model->attributes = $_POST['sUserRegistration'];
            if ($model->validate()) {
                $_mysalt = sUserRegistration::model()->generateSalt();
                $_password = md5($_mysalt . $model->password);
                sUserRegistration::model()->updateByPk((int)$id, ['password' => $_password, 'activation_code' => $_mysalt]);
                $this->redirect(['view', 'id' => $model->id]);
            }
        }
        $this->render('updatePassword', [
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['/sUserRegistration']);
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new sUserRegistration('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['sUserRegistration']))
            $model->attributes = $_GET['sUserRegistration'];
        $this->render('index', [
            'model' => $model,
        ]);
    }

    /* public function actionGenerateSalt()
      {
      $criteria=new CDbCriteria;
      //$criteria->addBetweenCondition('id',2,12344);
      $criteria->addBetweenCondition('id',10001,12344);
      $models=sUserRegistration::model()->findAll($criteria);
      foreach ($models as $model) {
      $_mysalt=uniqid('',true);
      $_password = md5($_mysalt . $model->email . $model->id);
      $model->activation_code=$_mysalt;
      $model->password=$_password;
      $model->save(false);
      //sUserRegistration::model()->updateByPk((int)$model->id,array('password'=>$_password,'activation_code'=>$_mysalt));
      }
      } */

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = sUserRegistration::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 's-user-registration-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
