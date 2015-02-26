<?php
$this->breadcrumbs = [
    'X Products' => ['index'],
    'Manage',
];

$this->menu = [
    ['label' => 'List xProduct', 'url' => ['index']],
    ['label' => 'Create xProduct', 'url' => ['create']],
];

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('x-product-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<h1>Manage X Products</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>,
    <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the
    beginning of each of your search values to specify how the comparison
    should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', ['class' => 'search-button']); ?>
<div class="search-form" style="display: none">
    <?php
    $this->renderPartial('_search', [
        'model' => $model,
    ]);
    ?>
</div>
<!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', [
    'id' => 'x-product-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        'id',
        'parent_id',
        'item_name',
        'photo_path',
        'created_date',
        'created_id',
        /*
          'updated_date',
          'updated_id',
         */
        [
            'class' => 'CButtonColumn',
        ],
    ],
]);
?>
