<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
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
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/tJournal']],
];

$this->menu1 = tJournal::getTopUpdated(1);
$this->menu2 = tJournal::getTopCreated(1);
?>


    <div class="page-header">
        <h1>
            Journal Voucher
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>