<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker4', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'issued_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
		$( \"#" . CHtml::activeId($model, 'valid_to') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>


<?php
/* @var $this GPersonOtherController */
/* @var $model gPersonOther */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'g-person-other-form',
            'enableAjaxValidation' => false,
            //'type'=>'horizontal',
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'category_name'); ?>
        <?php echo $form->textFieldGroup($model, 'document_number'); ?>
        <?php echo $form->textFieldGroup($model, 'issued_date'); ?>
        <?php echo $form->textFieldGroup($model, 'valid_to'); ?>
        <?php echo $form->textAreaGroup($model, 'custom_info1', ['widgetOptions' => ['htmlOptions' => ['rows' => 2]]]); ?>
        <?php echo $form->textAreaGroup($model, 'remark', ['rows' => 4, 'class' => 'col-md-4']); ?>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <?php
                $this->widget('booster.widgets.TbButton', [
                    'buttonType' => 'submit',
                    'context' => 'primary',
                    'icon' => 'fa fa-check',
                    'label' => $model->isNewRecord ? 'Create' : 'Save',
                ]);
                ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div><!-- form -->