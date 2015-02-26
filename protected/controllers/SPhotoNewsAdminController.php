<?php

class sPhotoNewsAdminController extends Controller
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
            //'accessControl',
        ];
    }

    public function actions()
    {
        return [
            //Photo News Admin Management
            'connectorPhotoDocumentsAdmin' => [
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => [
                    'root' => Yii::getPathOfAlias('webroot.shareimages'),
                    'URL' => Yii::app()->baseUrl . '/shareimages/',
                    'rootAlias' => 'Photo',
                    'mimeDetect' => 'none',
                ]
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new fPhoto;
        if (isset($_POST['fPhoto'])) {
            $model->attributes = $_POST['fPhoto'];
            if ($model->validate()) {

                mkdir(Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->sanitize());
                //Make XML
                $folder = Yii::getPathOfAlias('webroot') . '/shareimages/photo/'; // folder for uploaded files
                $foldernew = Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->sanitize() .'/'; 

                $File = $folder . date("Ymd") . "-" . $model->sanitize() . ".xml";
                $Handle = fopen($File, 'w');
                $Data = '<?xml version="1.0" encoding="ISO-8859-1"?>';
                fwrite($Handle, $Data);
                $Data = "<album>";
                fwrite($Handle, $Data);
                $Data = "<title>";
                fwrite($Handle, $Data);
                $Data = $model->sanitizeTitle();
                fwrite($Handle, $Data);
                $Data = "</title>";
                fwrite($Handle, $Data);
                $Data = "<description>";
                fwrite($Handle, $Data);
                $Data = $model->sanitizeDesc();
                fwrite($Handle, $Data);
                $Data = "</description>";
                fwrite($Handle, $Data);
                $Data = "<publish_date>";
                fwrite($Handle, $Data);
                $Data = $model->datetime;
                fwrite($Handle, $Data);
                $Data = "</publish_date>";
                fwrite($Handle, $Data);
                $Data = "</album>";
                fwrite($Handle, $Data);
                fclose($Handle);

                $model->images = CUploadedFile::getInstance($model, 'images');
                $model->images->saveAs($folder . $model->images->name);

                //Rename File
                copy($folder . $model->images->name, $folder . date("Ymd") . "-" . $model->sanitize() . ".jpg");
                copy($folder . $model->images->name, $foldernew . date("Ymd") . "-" . $model->sanitize() . ".jpg");
                unlink($folder . $model->images->name);
                //resize
                Yii::import('ext.iwi.Iwi');
                $picture = new Iwi(Yii::app()->basePath . "/../shareimages/photo/" . date("Ymd") . "-" . $model->sanitize() . ".jpg");
                $picture->resize(570, 428, Iwi::AUTO);
                $picture->save(Yii::app()->basePath . "/../shareimages/photo/" . date("Ymd") . "-" . $model->sanitize() . ".jpg", TRUE);
                //change permission
                chmod(Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->sanitize() . ".jpg", "0777");
                $model = new fPhoto;
            }
        }
        $this->render('index', ['model' => $model]);
    }

    public function actionUpload()
    {
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) &&
            (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
        ) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }
        $data = [];
        $model = new fPhoto('upload');
        $model->images = CUploadedFile::getInstance($model, 'images');
        if ($model->images !== null && $model->validate(['images'])) {
            $model->saveAs(Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->sanitize() . '/' . $pic->name);
            $model->file_name = $model->images->name;
            if ($model->save()) {
                // return data to the fileuploader
                $data[] = [
                    'name' => $model->images->name,
                    'type' => $model->images->type,
                    'size' => $model->images->size,
                    // we need to return the place where our image has been saved
                    //'url' => $model->getImageUrl(), // Should we add a helper method?
                    // we need to provide a thumbnail url to display on the list
                    // after upload. Again, the helper method now getting thumbnail.
                    //	'thumbnail_url' => $model->getImageUrl(MyModel::IMG_THUMBNAIL),
                    // we need to include the action that is going to delete the picture
                    // if we want to after loading
                    //'delete_url' => $this->createUrl('my/delete',
                    //	array('id' => $model->id, 'method' => 'uploader')),
                    //'delete_type' => 'POST'
                ];
            } else {
                $data[] = ['error' => 'Unable to save model after saving picture'];
            }
        } else {
            if ($model->hasErrors('images')) {
                $data[] = ['error', $model->getErrors('images')];
            } else {
                throw new CHttpException(500, "Could not upload file " . CHtml::errorSummary($model));
            }
        }
        echo json_encode($data);
    }

}
