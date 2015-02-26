<?php

class UPoController extends Controller
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

        $this->render('view', [
            'model' => $this->loadModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new fPo;

        if (isset($_POST['item_id'])) {
            $model->attributes = $_POST['fPo'];

            $model->item_id = $_POST['item_id'];
            $model->description = $_POST['description'];
            $model->qty = $_POST['qty'];
            $model->amount = $_POST['amount'];


            //foreach ($model->credit as $_credit)
            //    $_myCredit = $_myCredit + $_credit;
            //if ($_myDebit == $_myCredit && $_myDebit != 0 && $_myCredit != 0) {
            //    $model->balance = "OK";
            //}
            //else
            //    $model->balance = "NOT OK";

            if ($model->validate()) {
                $modelHeader = new uPo;

                $modelHeader->supplier_id = $_POST['fPo']['supplier_id'];
                $modelHeader->input_date = $_POST['fPo']['input_date'];
                $modelHeader->po_type_id = $_POST['fPo']['po_type_id'];
                $modelHeader->remark = $_POST['fPo']['remark'];

                $modelHeader->entity_id = sUser::model()->myGroup; //default Group
                $modelHeader->state_id = 1;

                $modelHeader->save();

                for ($i = 0; $i < sizeof($model->item_id); ++$i):
                    $modelDetail = new uPoDetail;
                    $modelDetail->parent_id = $modelHeader->id;
                    $modelDetail->item_id = $model->item_id[$i];
                    $modelDetail->description = $model->description[$i];
                    $modelDetail->qty = $model->qty[$i];
                    $modelDetail->amount = $model->amount[$i];
                    $modelDetail->save();
                endfor;

                //Create System_ref
                $_ref = "SO-" . str_pad($modelHeader->id, 5, "0", STR_PAD_LEFT);
                $modelHeader->updateByPk((int)$modelHeader->id, ['system_ref' => $_ref]);

                Yii::app()->user->setFlash("success", "<strong>Great!</strong> Purchased Order created succesfully...");
                $this->redirect(['/m2/uPo']);
            }
        }

        $this->render('create', ['model' => $model]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    /* 	public function actionUpdate($id)
      {
      $model=$this->loadModel($id);

      // Uncomment the following line if AJAX validation is needed
      // $this->performAjaxValidation($model);

      if(isset($_POST['uPo']))
      {
      $model->attributes=$_POST['uPo'];
      if($model->save())
      $this->redirect(array('view','id'=>$model->id));
      }

      $this->render('update',array(
      'model'=>$model,
      ));
      }
     */
    public function actionUpdate($id)
    {
        $model = new fPo;
        $modelHeader = uPo::model()->findByPk((int)$id);

        if ($modelHeader->state_id == 2) {
            Yii::app()->user->setFlash("error", "<strong>Error!</strong> Purchased already delivered. It has been locked...");
            $this->redirect(['/m2/uPo/view', 'id' => $modelHeader->id]);
        }

        //$model->balance = "NOT OK";

        if (isset($_POST['item_id'])) {
            $model->attributes = $_POST['fPo'];

            $model->item_id = $_POST['item_id'];
            $model->description = $_POST['description'];
            $model->qty = $_POST['qty'];
            $model->amount = $_POST['amount'];


            //foreach ($model->credit as $_credit)
            //    $_myCredit = $_myCredit + $_credit;
            //if ($_myDebit == $_myCredit && $_myDebit != 0 && $_myCredit != 0) {
            //    $model->balance = "OK";
            //}
            //else
            //    $model->balance = "NOT OK";

            if ($model->validate()) {
                $modelHeader->supplier_id = $_POST['fPo']['supplier_id'];
                $modelHeader->input_date = $_POST['fPo']['input_date'];
                $modelHeader->po_type_id = $_POST['fPo']['po_type_id'];
                $modelHeader->remark = $_POST['fPo']['remark'];

                $modelHeader->entity_id = sUser::model()->myGroup; //default Group
                $modelHeader->state_id = 1;

                $modelHeader->save();

                $t = uPoDetail::model()->deleteAll([
                    'condition' => 'parent_id = :id',
                    'params' => [':id' => $id],
                ]); //delete All Journal

                for ($i = 0; $i < sizeof($model->item_id); ++$i):
                    $modelDetail = new uPoDetail;
                    $modelDetail->parent_id = $modelHeader->id;
                    $modelDetail->item_id = $model->item_id[$i];
                    $modelDetail->description = $model->description[$i];
                    $modelDetail->qty = $model->qty[$i];
                    $modelDetail->amount = $model->amount[$i];
                    $modelDetail->save();
                endfor;

                Yii::app()->user->setFlash("success", "<strong>Great!</strong> Purchased Order updated succesfully...");
                $this->redirect(['/m2/uPo/view', 'id' => $modelHeader->id]);
                //$this->redirect(array('/m2/tJournal'));
            }
        }

        if (!isset($_POST['item_id'])) {
            $model->supplier_id = $modelHeader->supplier_id;
            $model->input_date = $modelHeader->input_date;
            $model->po_type_id = $modelHeader->po_type_id;
            $model->remark = $modelHeader->remark;

            $modelDetail = uPoDetail::model()->findAll([
                'condition' => 'parent_id = :id',
                'params' => [':id' => $modelHeader->id],
            ]);

            foreach ($modelDetail as $mm) {
                $model->item_id[] = $mm->item_id;

                $model->description[] = $mm->description;

                $model->qty[] = $mm->qty;

                $model->amount[] = $mm->amount;
            }
        }

        $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $modelHeader = $this->loadModel($id);

        if ($modelHeader->state_id == 2) {
            Yii::app()->user->setFlash("error", "<strong>Error!</strong> Purchased Order already delivered. It has been locked...");
            $this->redirect(['/m2/uPo/view', 'id' => $modelHeader->id]);
        }

        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $modelHeader->delete();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(['index']);
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.

     */
    public function actionIndex()
    {
        $this->render('index', [
        ]);
    }

    public function actionOnDelivered()
    {
        $this->render('onDelivered', [
        ]);
    }

    public function actionOnPaid()
    {
        $this->render('onPaid', [
        ]);
    }

    public function actionOnHalfPaid()
    {
        $this->render('onHalfPaid', [
        ]);
    }

    public function actionToDelivered($id)
    {
        $model = $this->loadModel($id);
        $model->state_id = 2; //delivered
        $model->save();

        $this->render('index', [
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {

        $model = uPo::model()->findByPk($id);

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

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'u-po-form') {

            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

}
