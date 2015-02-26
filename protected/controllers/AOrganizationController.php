<?php

class AOrganizationController extends Controller
{

    public $layout = '//layouts/column2';

    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function actionView($id)
    {
        $modelOrganization = $this->newOrganization($id);
        $this->render('view', [
            'model' => $this->loadModel($id),
            'modelOrganization' => $modelOrganization,
        ]);
    }

    public function newOrganization($id)
    {
        $model = new aOrganization;
        // $this->performAjaxValidation($model);
        if (isset($_POST['aOrganization'])) {
            $model->attributes = $_POST['aOrganization'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id]);
        }
        return $model;
    }

    public function actionViewSelf($id)
    {
        $this->layout = '//layouts/column1';
        $this->render('viewSelf', [
            'model' => $this->loadModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new aOrganization;
        // $this->performAjaxValidation($model);
        if (isset($_POST['aOrganization'])) {
            $model->attributes = $_POST['aOrganization'];
            $model->parent_id = 0;
            if ($model->save())
                $this->redirect(['view', 'id' => $model->id]);
        }
        $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['aOrganization'])) {
            $model->attributes = $_POST['aOrganization'];
            if ($model->save())
                //$this->redirect(array('/m1/gLeave'));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel($id)->delete();
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['/aOrganization']);
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionIndex()
    {
        $model = new aOrganization('search');
        $model->unsetAttributes();
        $criteria = new CDbCriteria;
        if (isset($_GET['aOrganization'])) {
            $model->attributes = $_GET['aOrganization'];
            $criteria->compare('name', $_GET['aOrganization']['name'], true);
            //$criteria->compare('branch_code', $_GET['aOrganization']['name'], true);
        }
        $criteria->order = 'updated_date DESC';
        $dataProvider = new CActiveDataProvider('aOrganization', [
            'criteria' => $criteria,
        ]);
        $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function loadModel($id)
    {
        $model = aOrganization::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'c-jemaat-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAjaxFillTree()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            exit();
        }
        if (Yii::app()->user->name != 'admin') {
            $parentId = "0 AND m1.id = 5 ";
        } else
            $parentId = 0;
        if (isset($_GET['root']) && $_GET['root'] !== 'source') {
            $parentId = (int)$_GET['root'];
        }
        $req = Yii::app()->db->createCommand(
            "SELECT m1.id, m1.name AS text, m2.id IS NOT NULL AS hasChildren "
            . "FROM a_organization AS m1 LEFT JOIN a_organization AS m2 ON m1.id=m2.parent_id "
            . "WHERE m1.parent_id = $parentId "
            . "GROUP BY m1.id ORDER BY m1.name ASC"
        );
        $children = $req->queryAll();
        $treedata = [];
        foreach ($children as $child) {
            $options = ['href' => Yii::app()->createUrl('aOrganization/view', ['id' => $child['id']]), 'id' => $child['id'], 'class' => 'treenode'];
            $nodeText = CHtml::openTag('a', $options);
            $nodeText .= $child['text'];
            $nodeText .= CHtml::closeTag('a') . "\n";
            $child['text'] = $nodeText;
            $treedata[] = $child;
        }
        //$children = $this->createLinks($children);
        echo str_replace(
            '"hasChildren":"0"', '"hasChildren":false',
            //CTreeView::saveDataAsJson($children)
            CTreeView::saveDataAsJson($treedata)
        );
        exit();
    }

    public function actionKabupatenUpdate()
    {
        $cat_id = $_POST['aOrganization']['propinsi_id'];
        $data = sKabupatenPropinsi::model()->findAll([
            'condition' => 'parent_id = :cat_id',
            'params' => [':cat_id' => $cat_id],
            'order' => 'sort'
        ]);
        $data = CHtml::listData($data, 'id', 'nama');
        foreach ($data as $value => $kabupaten_id) {
            echo CHtml::tag('option', ['value' => $value], CHtml::encode($kabupaten_id), true);
        }
    }

    public function actionOrganizationAutoComplete()
    {
        $res = [];
        if (isset($_GET['term'])) {
            $qtxt = "SELECT name as label, id FROM a_organization WHERE name LIKE :name ORDER BY name LIMIT 20";
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionUpload($id)
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
        //$folder='shareimages/hr/employee/temp/';  // folder for uploaded files
        $folder = 'shareimages/company/'; // folder for uploaded files
        $allowedExtensions = ["jpg"]; //array("jpg","jpeg","gif","exe","mov" and etc...
        //$sizeLimit = 5 * 1024 * 1024;// maximum file size in bytes
        $sizeLimit = 500 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
        $fileName = $result['filename']; //GETTING FILE NAME
        //Yii::import('ext.iwi.Iwi');
        //$picture = new Iwi(Yii::app()->basePath . "/../shareimages/hr/employee/temp/".$fileName);
        //$picture->resize(360,480, Iwi::AUTO);
        //$picture->save(Yii::app()->basePath . "/../shareimages/hr/employee/".$id."-".$fileName, TRUE);
        //gPerson::model()->updateByPk($id,array('c_pathfoto'=>$id."-".$fileName,'updated_date'=>time(),'updated_by'=>Yii::app()->user->id));
        aOrganization::model()->updateByPk($id, ['photo_path' => $fileName, 'updated_date' => time(), 'updated_by' => Yii::app()->user->id]);
        echo $return; // it's array
    }

    public function actionUpdateAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('aOrganization'); // 'User' is classname of model to be updated
        $es->update();
    }

}
