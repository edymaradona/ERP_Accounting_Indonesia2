<?php

class GHrParameterController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function actionIndex()
    {
        $modelParamLevel = $this->newParamLevel();
        $modelParamPermission = $this->newParamPermission();
        $modelParamPayroll = $this->newParamPayroll();
        $modelParamSelection = $this->newParamSelection();
        $modelParamMedical = $this->newParamMedical();

        $this->render('index', [
            'modelParamLevel' => $modelParamLevel,
            'modelParamPermission' => $modelParamPermission,
            'modelParamPayroll' => $modelParamPayroll,
            'modelParamSelection' => $modelParamSelection,
            'modelParamMedical' => $modelParamMedical,
        ]);
    }

    public function newParamLevel()
    {
        $model = new gParamLevel;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamLevel'])) {
            $model->attributes = $_POST['gParamLevel'];
            $model->parent_id = 0;
            if ($model->save())
                $this->refresh();
        }

        return $model;
    }

    public function newParamPayroll()
    {
        $model = new gParamPayroll;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamPayroll'])) {
            $model->attributes = $_POST['gParamPayroll'];
            $model->parent_id = 0;
            if ($model->save())
                $this->refresh();
        }

        return $model;
    }

    public function newParamSelection()
    {
        $model = new gParamSelection;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamSelection'])) {
            $model->attributes = $_POST['gParamSelection'];
            if ($model->save())
                $this->refresh();
        }

        return $model;
    }

    public function newParamMedical()
    {
        $model = new gParamMedical;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamMedical'])) {
            $model->attributes = $_POST['gParamMedical'];
            $model->company_id = sUser::model()->myGroup;
            if ($model->save())
                $this->refresh();
        }

        return $model;
    }

    public function actionUpdateParamLevelAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gParamLevel'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionDeleteParamLevel($id)
    {
        $this->loadModelParamLevel($id)->delete();
    }

    public function loadModelParamLevel($id)
    {
        $model = gParamLevel::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function actionUpdateParamSelectionAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gParamSelection'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionUpdateParamMedicalAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gParamMedical'); // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionUpdateParamPayrollAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gParamPayroll'); // 'User' is classname of model to be updated
        $es->update();
    }


    public function actionDeleteParamMedical($id)
    {
        $this->loadModelParamMedical($id)->delete();
    }


    public function actionDeleteParamSelection($id)
    {
        $this->loadModelParamSelection($id)->delete();
    }

    public function loadModelParamSelection($id)
    {
        $model = gParamSelection::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelParamMedical($id)
    {
        $model = gParamMedical::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function newParamPermission()
    {
        $model = new gParamPermission;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamPermission'])) {
            $model->attributes = $_POST['gParamPermission'];
            $model->parent_id = 0;
            if ($model->save())
                $this->refresh();
        }

        return $model;
    }

    public function actionUpdateParamPermissionAjax()
    {
        $model->attributes = $_POST;
        $model = $this->loadModelParamPermission($_POST['pk']);
        $model->$_POST['name'] = $_POST['value'];
        if ($model->save()) {
            return true;
        } else
            return false;
    }

    public function actionDeleteParamPermission($id)
    {
        $this->loadModelParamPermission($id)->delete();
    }

    public function loadModelParamPermission($id)
    {
        $model = gParamPermission::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

}
