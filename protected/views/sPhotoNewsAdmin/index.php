<?php
$this->breadcrumbs = [
];
?>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker2', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'datetime') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
		});
                            
                });

		");
?>

<div class="page-header">
    <h1>
        <i class="fa fa-picture-o fa-fw"></i>
        Photo Managements
    </h1>
</div>


<h2>New Photo Album</h2>
<div class="row">
    <div class="col-md-9">

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'module-matrix-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
            'htmlOptions' => ['enctype' => 'multipart/form-data'],
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'datetime', ['class' => 'col-md-2']); ?>

        <?php echo $form->textFieldGroup($model, 'title', ['class' => 'col-md-5']); ?>

        <?php echo $form->textAreaGroup($model, 'description', ['class' => 'col-md-7', 'rows' => 3, 'hint' => 'Maximum 5000 characters']); ?>

        <?php
        //echo $form->html5EditorRow($model, 'description', array(
        //	'class' => 'col-md-7', 'rows' => 5, 'height' => '200', 'options' => array('color' => true)));
        ?>

        <?php echo $form->fileFieldGroup($model, 'images'); ?>

        <?php /*
          <div class="control-group">
          <label class="control-label required">Upload Files</label>
          <div class="controls">
          <?php
          $this->widget('CMultiFileUpload', array(
          'model' => $model,
          'attribute' => 'images',
          'accept' => 'jpg',
          'options' => array(
          ),
          ));
          ?>
          </div>
          </div>

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


        <div class="control-group">
            <?php echo CHtml::htmlButton('<i class="fa fa-check fa-fw"></i>Upload', ['class' => 'btn', 'type' => 'submit']); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>

<br/>
<?php
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', [
        'connectorRoute' => 'sPhotoNewsAdmin/connectorPhotoDocumentsAdmin',
    ]
);
?>
