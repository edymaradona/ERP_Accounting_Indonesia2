<?php

class UArController extends Controller
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
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = uAr::model()->findByPk($id);

        if ($model == null) {
            $modelSo = uSo::model()->findByPk((int)$id);

            $modelAr = new uAr;
            $modelAr->id = $modelSo->id;
            $modelAr->entity_id = sUser::model()->myGroup;
            $modelAr->periode_date = Yii::app()->params["cCurrentPeriod"];
            $modelAr->ar_type_id = 1; //default
            $modelAr->payment_state_id = 1;
            $modelAr->journal_state_id = 1;
            $modelAr->total_amount = (int)$modelSo->soSum;
            $modelAr->save();
            $model = $modelAr;
        }

        $payment = $this->newPayment($id);

        $this->render('view', [
            'model' => $model,
            'modelPayment' => $payment,
        ]);
    }

    public function newPayment($id)
    {
        $model = new uArPayment;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['uArPayment'])) {
            $model->attributes = $_POST['uArPayment'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['/m2/uAr']);
        }

        return $model;
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {

        if (Yii::app()->request->isPostRequest) {

            // we only allow deletion via POST request

            $this->loadModel($id)->delete();


            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionIndex()
    {
        $this->render('index', [
        ]);
    }

    public function actionOnHalfPaid()
    {
        $this->render('onHalfPaid', [
        ]);
    }

    public function actionOnPaid()
    {
        $this->render('onPaid', [
        ]);
    }

    public function actionOnRecent()
    {
        $this->render('onRecent', [
        ]);
    }

    public function actionArCustomer()
    {
        $this->render('arCustomer', [
        ]);
    }

    public function actionArCustomerView($id)
    {
        $model = $this->loadModelCustomer($id);
        $this->render('arCustomerView', [
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
        $model = uAr::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelCustomer($id)
    {
        $model = uCustomer::model()->findByPk($id);
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

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'u-ar-form') {

            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

}
