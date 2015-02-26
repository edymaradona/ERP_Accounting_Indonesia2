<?php
$this->breadcrumbs = [
    'Ea Asset Categories' => ['index'],
    'Manage',
];
$this->menu = [
    ['label' => 'List eaAssetCategory', 'url' => ['index']],
    ['label' => 'Create eaAssetCategory', 'url' => ['create']],
];
Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('ea-asset-category-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>
    <div class="page-header">
        <h1>Manage Ea Asset Categories</h1>
    </div>
    <p>
        You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>,
        <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the
        beginning of each of your search values to specify how the comparison
        should be done.
    </p>
<?php echo CHtml::link('Advanced Search', '#', ['class' => 'search-button']); ?>

<?php
$this->renderPartial('_search', [
    'model' => $model,
]);
?>

<?php
$this->widget('zii.widgets.grid.CGridView', [
    'id' => 'ea-asset-category-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        'id',
        'parent_id',
        'inventory_type',
        'type1_info',
        'type2_info',
        'remarks',
        [
            'class' => 'TbButtonColumn',
        ],
    ],
]);
?>