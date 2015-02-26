<?php

$form = $this->beginWidget('TbActiveForm', [
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'id' => 'searchForm',
    'htmlOptions' => ['class' => 'form-inline'],
]);
?>

<?php

$this->widget('zii.widgets.jui.CJuiAutoComplete', [
    'model' => $model,
    'attribute' => 'account_name',
    'source' => $this->createUrl('/m2/tAccount/accountAutoComplete'),
    'options' => [
        'minLength' => '2',
        'focus' => 'js:function( event, ui ) {
						$("#' . CHtml::activeId($model, 'account_name') . '").val(ui.item.label);
						return false;
					}',
        'select' => 'js:function( event, ui ) {
						$("#searchForm").submit();
						return false;
					}',
    ],
    'htmlOptions' => [
        'class' => 'col-md-4',
        'placeholder' => 'Search Account Name',
    ],
]);
?>

<?php echo CHtml::htmlButton('<i class="icon-fa-search"></i>Search', ['class' => 'btn', 'type' => 'submit']); ?>

<?php $this->endWidget(); ?>
