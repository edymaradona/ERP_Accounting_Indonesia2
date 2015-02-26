<?php

/** @var TbActiveForm $form */
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'method' => 'get',
    'id' => 'searchForm',
    //'action'=>Yii::app()->createUrl('/m1/gPerson/view',array("id"=>$_GET['name']),
    'htmlOptions' => ['class' => 'form-inline'],
]);
?>

<?php echo $form->textField($model, 'name', ['class' => 'col-md-3']); ?>
<?php

$this->widget('booster.widgets.TbButton', [
    'buttonType' => 'submit',
    // 'type' => 'primary',
    'label' => 'Search',
    'icon' => 'search'
]);
?>

<?php $this->endWidget(); ?>

