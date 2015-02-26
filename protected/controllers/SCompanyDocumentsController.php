<?php

class SCompanyDocumentsController extends Controller
{

    public $layout = '//layouts/mainAuth';

    public function filters()
    {
        return [
            //'accessControl',
            'rights',
        ];
    }

    public function actions()
    {
        return [
            //Admin Share for All Authenticated User
            'connectorCompanyDocuments' => [
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => [
                    'root' => Yii::getPathOfAlias('webroot.sharedocs.companydocuments'),
                    'URL' => Yii::app()->baseUrl . '/sharedocs/companydocuments/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                    //'uploadDeny'    => array(Yii::app()->user->name),
                    'disabled' => ['upload', 'mkdir', 'mkfile', 'mv', 'rm', 'cp'], // list of not allowed commands
                    'defaults' => ['read' => true, 'write' => false],
                ]
            ],
            'connectorPublicDocuments' => [
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => [
                    'root' => Yii::getPathOfAlias('webroot.sharedocs.publicdocuments'),
                    'URL' => Yii::app()->baseUrl . '/sharedocs/publicdocuments/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                ]
            ],
            'connectorPersonalDocuments' => [
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => [
                    'root' => Yii::getPathOfAlias('webroot.sharedocs.personaldocuments') . '/' . Yii::app()->user->name . '/',
                    'URL' => Yii::app()->baseUrl . '/sharedocs/personaldocuments/' . Yii::app()->user->name . '/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                ]
            ],
            'connectorPersonalPerformance' => [
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => [
                    'root' => Yii::getPathOfAlias('webroot.sharedocs.personalperformance') . '/' . Yii::app()->user->name . '/',
                    'URL' => Yii::app()->baseUrl . '/sharedocs/personalperformance/' . Yii::app()->user->name . '/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                ]
            ],
        ];
    }

    public function actionIndex()
    {
        //Yii::import("ext.yiiext.components.zendAutoloader.EZendAutoloader", true);
        //Yii::import('application.vendors.*');
        require_once('Zend/Search/Lucene.php');

        //$this->layout = 'column2';
        if (($term = Yii::app()->getRequest()->getParam('q', null)) !== null) {
            $index = Zend_Search_Lucene::open(Yii::app()->basePath . "/runtime/search");
            $index->setResultSetLimit(5);
            $results = $index->find($term);
            $query = Zend_Search_Lucene_Search_QueryParser::parse($term);
            $this->render('index', compact('results', 'term', 'query'));
        }
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
