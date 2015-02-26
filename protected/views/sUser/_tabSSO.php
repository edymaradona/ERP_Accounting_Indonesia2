<br/>

<?php

$form = $this->beginWidget('TbActiveForm', [
    'action' => Yii::app()->createUrl('/sUser/sso', ["id" => $model->id]),
    'method' => 'post',
    'type' => 'inline',
]);
?>

<?php

$this->widget('zii.widgets.jui.CJuiAutoComplete', [
    'model' => $model,
    'attribute' => 'sso_name',
    'sourceUrl' => Yii::app()->createUrl('/m1/gPerson/personAutoCompleteIdAdmin'),
    'options' => [
        'minLength' => '2',
        'focus' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'sso_name') . '").val(ui.item.label);
					return false;
				}',
        'select' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'sso_id') . '").val(ui.item.id);
					return false;
				}',
    ],
    'htmlOptions' => [
        'class' => 'form-control'
    ],
]);
?>

<?php echo $form->hiddenField($model, 'sso_id', []); ?>

<?php echo CHtml::htmlButton('<i class="fa fa-check fa-fw"></i>Assign', ['class' => 'btn', 'type' => 'submit']); ?>

<?php $this->endWidget(); ?>
