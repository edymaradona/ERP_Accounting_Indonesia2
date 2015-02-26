<?php
$this->breadcrumbs = [
    'Address Book' => ['index'],
    'Manage',
];
Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('daddressbook-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>
    <div class="page-header">
        <h1>Address Book</h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>
    <br/>
    <hr/>
<?php echo CHtml::link('Advanced Search', '#', ['class' => 'search-button']); ?>

<?php
$this->renderPartial('_search', [
    'model' => $model,
]);
?>
<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'daddressbook-grid',
    'dataProvider' => $model->search(),
    //'filter'=>$model,
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'columns' => [
        [
            'class' => 'TbButtonColumn',
        ],
        'complete_name',
        'company_name',
        'title',
        /* 		'address1',
          'address2',
          'address3', */
        'handphone',
        'email',
    ],
]);
?>