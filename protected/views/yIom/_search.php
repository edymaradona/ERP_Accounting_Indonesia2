<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'method' => 'get',
    'id' => 'searchForm',
    'htmlOptions' => ['class' => 'form-inline'],
]);
?>

<?php echo $form->textField($model, 'subject', ['class' => 'col-md-7', 'maxlength' => 100]); ?>

<?php

$this->widget('booster.widgets.TbButton', [
    'buttonType' => 'submit',
    // 'type' => 'primary',
    'label' => 'Search',
    'icon' => 'search'
]);
?>

<?php $this->endWidget(); ?>

