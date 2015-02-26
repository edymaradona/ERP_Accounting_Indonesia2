<?php

class sCompanyNewsUnitController extends Controller
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

    public function actions()
    {
        return [
            'compressor' => [
                'class' => 'ext.tinymce.TinyMceCompressorAction',
                'settings' => [
                    'compress' => true,
                    'disk_cache' => true,
                ]
            ],
            'spellchecker' => [
                'class' => 'ext.tinymce.TinyMceSpellcheckerAction',
            ],
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
        $model->setScenario('businessunit');
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (isset($_POST['sCompanyNews'])) {
            $model->attributes = $_POST['sCompanyNews'];
            $model->priority_id = 1; //Normal Priority
            $model->category_id = 8; //Business Unit Only
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

        $model2 = new fPhoto;
        $model2->setScenario('businessunit');
        if (isset($_POST['fPhoto'])) {
            $model2->attributes = $_POST['fPhoto'];
            if ($model2->validate()) {

                //Make XML
                $File = Yii::getPathOfAlias('webroot') . '/shareimages/photo2/' . date("Ymd") . "-" . $model2->sanitize() . ".xml";
                $Handle = fopen($File, 'w');
                $Data = '<?xml version="1.0" encoding="ISO-8859-1"?>';
                fwrite($Handle, $Data);
                $Data = "<album>";
                fwrite($Handle, $Data);
                $Data = "<title>";
                fwrite($Handle, $Data);
                $Data = $model2->sanitizeTitle();
                fwrite($Handle, $Data);
                $Data = "</title>";
                fwrite($Handle, $Data);
                $Data = "<description>";
                fwrite($Handle, $Data);
                $Data = $model2->sanitizeDesc();
                fwrite($Handle, $Data);
                $Data = "</description>";
                fwrite($Handle, $Data);
                $Data = "<publish_date>";
                fwrite($Handle, $Data);
                $Data = $model2->datetime;
                fwrite($Handle, $Data);
                $Data = "</publish_date>";
                fwrite($Handle, $Data);

                $Data = "<company>";
                fwrite($Handle, $Data);
                $Data = sUser::model()->myGroup;
                fwrite($Handle, $Data);
                $Data = "</company>";
                fwrite($Handle, $Data);

                $Data = "</album>";
                fwrite($Handle, $Data);
                fclose($Handle);
                $model2->images = CUploadedFile::getInstance($model2, 'images');
                $model2->images->saveAs(Yii::getPathOfAlias('webroot') . '/shareimages/photo2/' . date("Ymd") . "-" . $model2->sanitize() . ".jpg");

                //resize
                Yii::import('ext.iwi.Iwi');
                $picture = new Iwi(Yii::app()->basePath . "/../shareimages/photo2/" . date("Ymd") . "-" . $model2->sanitize() . ".jpg");
                $picture->resize(570, 428, Iwi::AUTO);
                $picture->save(Yii::app()->basePath . "/../shareimages/photo2/" . date("Ymd") . "-" . $model2->sanitize() . ".jpg", TRUE);
                //change permission
                chmod(Yii::getPathOfAlias('webroot') . '/shareimages/photo2/' . date("Ymd") . "-" . $model2->sanitize() . ".jpg", "0777");
                $model2 = new fPhoto;
                Yii::app()->user->setFlash('success', '<strong>Great!</strong> Photo upload has been success');
            }
        }

        $this->render('index', [
            'model' => $model,
            'model2' => $model2,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = sCompanyNews::model()->findByPk($id, ['condition' => 'category_id = 8']);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
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
