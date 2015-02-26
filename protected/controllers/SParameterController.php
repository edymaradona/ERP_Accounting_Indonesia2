<?php

class SParameterController extends Controller
{

    public $layout = '//layouts/column1';

    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function newParameter($type = null)
    {
        $model = new sParameter;
        // $this->performAjaxValidation($model);
        if (isset($_POST['sParameter'])) {
            $model->attributes = $_POST['sParameter'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', '<strong>Great!</strong> data has been saved successfully');
                $this->redirect(['/sParameter/index', 'type' => $type]);
            }
        }
        if (isset($_GET['type'])) {
            $model->type = $_GET['type'];
            $model->code = sParameter::lastItem($_GET['type']);
        }
        return $model;
    }

    public function actionUpdateEducation($id)
    {
        $model = $this->loadModelEducation($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['gPersonEducation'])) {
            $model->attributes = $_POST['gPersonEducation'];
            if ($model->save())
                //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }
        EQuickDlgs::render('_formEducation', ['model' => $model]);
    }

    public function actionUpdate($pk1, $pk2)
    {
        $model = $this->loadModel($pk1, $pk2);
        // $this->performAjaxValidation($model);
        if (isset($_POST['sParameter'])) {
            $model->attributes = $_POST['sParameter'];
            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
            }
        }
        EQuickDlgs::render('update', ['model' => $model]);
    }

    public function actionDelete($pk1, $pk2)
    {
        $this->loadModel($pk1, $pk2)->delete();
        $this->redirect(['/sParameter']);
    }

    public function actionIndex($type = null)
    {
        $parameter = $this->newParameter($type);
        $model = new sParameter('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['sParameter']))
            $model->attributes = $_GET['sParameter'];
        $this->render('index', [
            'model' => $model,
            'type' => $type,
            'modelParameter' => $parameter,
        ]);
    }

    public function loadModel($pk1, $pk2)
    {
        $model = sParameter::model()->find([
            'condition' => 'type = :pk1 AND code = :pk2',
            'params' => [':pk1' => $pk1, ':pk2' => $pk2],
        ]);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'parameter-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
