<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl() . '/jui/css/2jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->getClientScript()->getCoreScriptUrl() . '/jui/css/2jui-bootstrap/jquery-ui.css');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');


Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
			
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
});

		");
?>


<?php
$this->breadcrumbs = [
    'Journal Voucher' => ['/m2/tJournal'],
    'Update',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/tJournal']],
    ['label' => 'View', 'icon' => 'edit', 'url' => ['view', 'id' => $model->master_id]],
];

$this->menu1 = tJournal::getTopUpdated(1);
$this->menu2 = tJournal::getTopCreated(1);
?>


    <div class="page-header">
        <h1>
            Update:
            <?php echo $model->system_ref; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>