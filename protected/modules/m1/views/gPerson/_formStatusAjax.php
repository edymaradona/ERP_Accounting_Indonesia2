<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker2', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
		});
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>

<div class="form">

    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 'g-person-status-form',
        'enableAjaxValidation' => false,
        //'type'=>'horizontal',
    ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldGroup($model, 'start_date', []); ?>

    <?php echo $form->textFieldGroup($model, 'end_date'); ?>

    <?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
        'data' => sParameter::items('AK')
    ]]); ?>

    <?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>

    <div class="form-group">
        <?php
        echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Save', CHtml::normalizeUrl(['/m1/gPerson/statusAjax']), [
            'data' => 'js:jQuery(this).parents("form").serialize() + "&parent_id=' . $id . '"',
            'success' => 'function(data){
							$.fn.yiiGridView.update("g-person-status-grid", {
								data: $(this).serialize()
							});
			}',
            'error' => 'function(data) { 
         		alert("Your input is not valid");
    		}',
        ], [
            'id' => 'ajaxSubmitBtn',
            'name' => 'ajaxSubmitBtn',
            'class' => 'btn btn-primary',
        ]);
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div>

