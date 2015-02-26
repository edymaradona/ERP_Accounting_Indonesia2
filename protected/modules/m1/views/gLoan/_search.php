<?php

Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
?>


<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'action' => Yii::app()->createUrl('/m1/gLoan/list'),
    'method' => 'get',
    'id' => 'searchForm',
    'htmlOptions' => ['class' => 'form-inline'],
]);
?>

<?php //echo $form->textField($model,'employee_name',array('class'=>'col-md-3','maxlength'=>100)); ?>
<?php

$this->widget('zii.widgets.jui.CJuiAutoComplete', [
    'model' => $model,
    'attribute' => 'employee_name',
    'source' => $this->createUrl('/m1/gPerson/personAutoComplete'),
    'options' => [
        'minLength' => '2',
        'focus' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'employee_name') . '").val(ui.item.label);
					return false;
}',
        'select' => 'js:function( event, ui ) {
					$("#searchForm").submit();
					return false;
}',
    ],
    'htmlOptions' => [
        'class' => 'form-control col-md-6',
        'placeholder' => 'Search Name',
    ],
]);
?>

<?php echo CHtml::htmlButton('<i class="fa fa-search fa-fw"></i>Search', ['class' => 'btn', 'type' => 'submit']); ?>

<?php $this->endWidget(); ?>

<br/>