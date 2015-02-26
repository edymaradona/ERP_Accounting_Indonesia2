<?php

Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
?>
<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'action' => $action,
    'method' => 'get',
    'id' => 'searchForm',
    'htmlOptions' => ['class' => 'form-inline'],
]);
?>

<?php //echo $form->textField($model,'employee_name',array('width'=>'100%','maxlength'=>100,'placeholder'=>'Search Name','prepend'=>'<i class="icon-fa-search"></i>')); ?>

<?php

$model->system_ref = null;
$this->widget('zii.widgets.jui.CJuiAutoComplete', [
    'model' => $model,
    'attribute' => 'system_ref',
    'source' => $this->createUrl('/m2/tJournal/journalAutoComplete'),
    'options' => [
        'minLength' => '2',
        'focus' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'system_ref') . '").val(ui.item.label);
					return false;
}',
        'select' => 'js:function( event, ui ) {
					$("#searchForm").submit();
					return false;
}',
    ],
    'htmlOptions' => [
        'width' => '100%',
        'placeholder' => 'Search NoRef or Remark',
        'prepend' => '<i class="icon-fa-search"></i>',
    ],
]);
?>


<?php echo CHtml::htmlButton('<i class="icon-fa-search"></i>', ['class' => 'btn', 'type' => 'submit']); ?>

<?php $this->endWidget(); ?>
