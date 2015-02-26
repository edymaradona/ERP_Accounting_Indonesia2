<style>
    .userautocompletelink {
        height: 52px;
    }

    .userautocompletelink img {
        float: left;
        margin-right: 5px;
        width: 40px;
    }

</style>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
    });

    $( \"#" . CHtml::activeId($model, 'process_date') . "\" ).datepicker({
    'dateFormat' : 'dd-mm-yy',
    });

    $( \"#" . CHtml::activeId($model, 'paid_date') . "\" ).datepicker({
    'dateFormat' : 'dd-mm-yy',
    });

		$( \"#" . CHtml::activeId($model, 'parent_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/m1/gPerson/personAutoCompletePhotoActive') . "',
			'focus': function( event, ui ) {
			   $(\"#" . CHtml::activeId($model, 'parent_name') . "\").val(ui.item.label);
			   return false;
			},
			'select': function( event, ui ) {
			   $(\"#" . CHtml::activeId($model, 'parent_id') . "\").val(ui.item.id);
         jQuery.ajax({
            'type':'POST',
            'url':'" . Yii::app()->createUrl('/m1/gLoan/familyUpdate') . "',
            'cache':false,
            'data':jQuery(this).parents(\"form\").serialize(),
            'success':function(html){
              jQuery(\"#" . CHtml::activeId($model, 'loan_for_id') . "\").html(html)
            }
          });

			   return false;
			},
			
		})
		.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\")
			.data( \"item.autocomplete\", item )
			.append('<a class=\'userautocompletelink\'><img src=\'" . Yii::app()->baseUrl . "/shareimages/hr/employee/thumb/" . "'+item.photo+'\'/><h5>'+item.label+'</h5></a>')
			.appendTo( ul );
		};
		
		
});

		");
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-loan-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'parent_name'); ?>

<?php /*
  <div class="form-group">
  <?php echo $form->labelEx($model,'parent_name',array('class'=>'control-label')); ?>
  <div class="col-sm-9">
  <?php
  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
  'model'=>$model,
  'attribute'=>'parent_name',
  'source'=>$this->createUrl('/m1/gPerson/personAutoCompleteId'),
  'options'=>array(
  'minLength'=>'2',
  'focus'=> 'js:function( event, ui ) {
  $("#'.CHtml::activeId($model,'parent_name').'").val(ui.item.label);
  return false;
  }',
  'select'=> 'js:function( event, ui ) {
  $("#'.CHtml::activeId($model,'parent_id').'").val(ui.item.id);
  return false;
  }',
  ),
  'htmlOptions'=>array(
  'class'=>'input-medium',
  'placeholder'=>'Search Name',
  'class'=>'col-md-4',
  ),
  ));

  ?>
  </div>
  </div>
 */
?>

<?php echo $form->hiddenField($model, 'parent_id'); ?>

<?php echo $form->textFieldGroup($model, 'input_date', ['widgetOptions' => [
    'htmlOptions' => ['disabled' => true, 'value' => date("d-m-Y")]
]]); ?>

<?php echo $form->dropDownListGroup($model, 'loan_type_id', ['widgetOptions' => [
    'data' => sParameter::items('cLoan')
]]); ?>

<?php echo $form->textAreaGroup($model, 'purpose', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>

<?php echo $form->numberFieldGroup($model, 'debit', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->numberFieldGroup($model, 'credit', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>



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
<?php
$this->endWidget();
?>

