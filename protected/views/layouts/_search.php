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

<?php //echo $form->textField($model,'employee_name',array('width'=>'100%','maxlength'=>100,'placeholder'=>'Search Name','prepend'=>'<i class="fa fa-search fa-fw"></i>')); ?>
<?php

$model->employee_name = null;
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
        'width' => '100%',
        'type' => 'search',
        'placeholder' => 'Search Name',
        'prepend' => '<i class="fa fa-search fa-fw"></i>',
    ],
]);
?>


<?php

$this->widget('booster.widgets.TbButton', [
    'buttonType' => 'submit',
    // 'type' => 'primary',
    'label' => 'Search',
    'icon' => 'search'
]);
?>

<?php $this->endWidget(); ?>
