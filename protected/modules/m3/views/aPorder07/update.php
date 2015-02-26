<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl() . '/jui/css/2jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->getClientScript()->getCoreScriptUrl() . '/jui/css/2jui-bootstrap/jquery-ui.css');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'periode_date') . "\" ).datepicker({
		'dateFormat':'yymm',
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'periode_date') . "\" ).mask('999999');
});

		");
?>


<?php
$this->breadcrumbs = [
    'Purchase Order 07 with Dept' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/m3/aPorder07']],
    ['label' => 'Create Simple PO', 'url' => ['create']],
];

$this->menu1 = aPorder::getTopUpdated07();
$this->menu2 = aPorder::getTopCreated07();
?>

    <div class="page-header">
        <h1>
            <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/cash.png') ?>
            Create New PO 07 with Dept
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'Create PO', 'url' => Yii::app()->createUrl('create')],
        ['label' => 'Create PO With Dept', 'url' => Yii::app()->createUrl('createDept')],
        ['label' => 'Create Non PO', 'url' => Yii::app()->createUrl('create')],
    ],
]);
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'aPorder-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'input_date'); ?>

<?php echo $form->textFieldRow($model, 'no_ref', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'periode_date'); ?>

<?php echo $form->dropDownListRow($model, 'budgetcomp_id', aBudget::mainComponent()); ?>


<?php echo $form->textAreaRow($model, 'remark', ['rows' => 2, 'cols' => 50]); ?>


<?php echo $form->dropDownListRow($model, 'issuer_id', sParameter::items("cIssuer")); ?>

    <div class="tabular">
        <?php
        $this->widget('ext.appendo.JAppendo', [
            'id' => 'repeateEnum',
            'model' => $model,
            'viewName' => '_detailPorderDept',
            'labelDel' => 'Remove Row'
            //'cssFile' => 'css/jquery.appendo2.css'
        ]);
        ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>' . $model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn', 'type' => 'submit']); ?>
    </div>
<?php $this->endWidget(); ?>