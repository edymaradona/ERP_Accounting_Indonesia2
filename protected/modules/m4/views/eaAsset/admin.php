<?php
$this->breadcrumbs = [
    'eaAssets' => ['index'],
    'Manage',
];
$this->menu = [
    ['label' => 'List eaAsset', 'url' => ['index']],
    ['label' => 'Create eaAsset', 'url' => ['create']],
];
Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('eaAsset-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>
<div class="page-header">
    <h1>Asset Management</h1>
</div>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'eaAsset-category-grid',
    'dataProvider' => eaAssetCategory::model()->mainsearch(),
    //'filter'=>$model,
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'columns' => [
        [
            'class' => 'TbButtonColumn',
        ],
        [
            'name' => 'inventory_type',
            'type' => 'raw',
            'value' => 'CHtml::link($data->inventory_type,Yii::app()->createUrl("/m1/eaAsset/admin2",array("id"=>$data->id)))',
        ],
        'remarks',
    ],
]);
?>
<hr/>
<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'action' => Yii::app()->createUrl($this->route),
    'type' => 'search',
    'method' => 'get',
    'htmlOptions' => ['class' => 'well'],
]);
?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'item', ['class' => 'col-md-3']); ?>
<?php echo CHtml::htmlButton('<i class="icon-fa-search"></i>Search', ['class' => 'btn', 'type' => 'submit']); ?>
<?php $this->endWidget(); ?>
<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
?>
