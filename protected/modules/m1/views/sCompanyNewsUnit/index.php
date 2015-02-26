<?php
/* @var $this SCompanyNewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Company News',
];

$this->menu = [
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

//$this->menu1 = sCompanyNews::getTopUpdated();
//$this->menu2 = sCompanyNews::getTopCreated();
$this->menu5 = ['Business Unit News'];
?>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker2', "
		$(function() {
		$( \"#" . CHtml::activeId($model2, 'datetime') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
		});
                            
                });

		");
?>

<div class="page-header">
    <h1>
        <i class="fa fa-article"></i>
        Business Unit News
    </h1>
</div>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'companynews-grid',
    'dataProvider' => $model->searchNewsUnit(),
    'filter' => $model,
    'itemsCssClass' => 'table table-striped',
    'template' => '{items}{pager}',
    'columns' => [
        [
            'name' => 'created_date',
            'value' => 'date("d-m-Y H:i",$data->created_date)',
            'filter' => false,
        ],
        [
            'name' => 'publish_date',
            'value' => 'peterFunc::nicetime(strtotime($data->publish_date))',
            'filter' => false,
        ],
        [
            'header' => 'Author',
            'name' => 'created.username',
        ],
        'category.category_name',
        [
            'name' => 'title',
            'type' => 'raw',
            'value' => 'CHtml::link($data->title,Yii::app()->createUrl("/m1/sCompanyNewsUnit/view",array("id"=>$data->id)))',
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{update}{delete}',
        ],
        [
            'header' => 'Priority',
            'name' => 'priority.name',
        ],
        [
            'header' => 'Approved Status',
            'name' => 'approved.name',
        ],
        [
            'name' => 'expire_date',
            'value' => 'peterFunc::nicetime(strtotime($data->expire_date))',
            'filter' => false,
        ],
    ],
]);
?>

<hr/>

<h3>Business Unit Activity Photo</h3>
<div class="row">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'module-matrix-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
            'htmlOptions' => ['enctype' => 'multipart/form-data'],
        ]);
        ?>

        <p class="note">Photo that you upload here, will show on Business Unit Activity Info outside before login...</p>

        <?php echo $form->errorSummary($model2); ?>

        <?php echo $form->textFieldGroup($model2, 'datetime'); ?>

        <?php echo $form->textFieldGroup($model2, 'title'); ?>

        <?php echo $form->textAreaGroup($model2, 'description', ['hint' => 'Maximum 5000 characters', 'widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>
        <?php
        //echo $form->html5EditorRow($model, 'description', array(
        //	'class' => 'col-md-7', 'rows' => 5, 'height' => '200', 'options' => array('color' => true)));
        ?>

        <?php echo $form->fileFieldGroup($model2, 'images'); ?>

        <?php /*
          <div class="form-group">
          <label class="control-label required">Upload Files</label>
          <div class="col-sm-9">
          <?php
          $this->widget('CMultiFileUpload', array(
          'model' => $model2,
          'attribute' => 'images',
          'accept' => 'jpg',
          'options' => array(
          ),
          ));
          ?>
          </div>
          </div>
         */
        ?>

        <?php /*
          <?php $this->widget('booster.widgets.TbFileUpload', array(
          'url' => $this->createUrl("sPhotoNewsAdmin/upload"),
          'model' => $model,
          'attribute' => 'images', // see the attribute?
          'multiple' => true,
          'options' => array(
          'maxFileSize' => 2000000,
          'acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i',
          ))); ?>

         */
        ?>


        <div class="form-group">
            <?php echo CHtml::htmlButton('<i class="fa fa-check fa-fw"></i>Upload', ['class' => 'btn', 'type' => 'submit']); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
