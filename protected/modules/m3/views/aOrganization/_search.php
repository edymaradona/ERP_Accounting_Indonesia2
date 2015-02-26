<?php

/** @var TbActiveForm $form */
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'searchForm',
    'type' => 'inline',
]);
?>

<?php echo $form->textFieldRow($model, 'name', ['class' => 'input-medium']); ?>
<?php echo CHtml::htmlButton('<i class="icon-fa-search"></i>Search', ['class' => 'btn', 'type' => 'submit']); ?>

<?php $this->endWidget(); ?>

