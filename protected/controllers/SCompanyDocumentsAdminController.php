<?php

class SCompanyDocumentsAdminController extends Controller
{

    public $layout = '//layouts/mainAuth';

    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function actions()
    {
        return [
            //Admin Share for All Authenticated User
            'connectorCompanyDocumentsAdmin' => [
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => [
                    'root' => Yii::getPathOfAlias('webroot.sharedocs.companydocuments'),
                    'URL' => Yii::app()->baseUrl . '/sharedocs/companydocuments/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                ]
            ],
        ];
    }

    public function actionIndex()
    {
        $this->render('companyDocumentsAdmin');
    }

}

/*
  //server file input
  $this->widget('ext.elFinder.ServerFileInput', array(
  'model' => $model,
  'attribute' => 'serverFile',
  'connectorRoute' => 'admin/elfinder/connector',
  )
  );
  // ElFinder widget
  $this->widget('ext.elFinder.ElFinderWidget', array(
  'connectorRoute' => 'admin/elfinder/connector',
  )
  );
 */
