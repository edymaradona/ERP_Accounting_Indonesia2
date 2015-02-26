<?php
$this->breadcrumbs=array(
	'Ec Libraries'=>array('index'),
	$model->title,
);

$this->menu=array(
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m5/ecLibrary']],
);
?>

<div class="page-header">
<h1><?php echo $model->title; ?></h1>
</div>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		array(
			'name'=>'category_id',
			'value'=>$model->category->name,
		),
		//'title',
		'description',
		'code',
		'location',
		'quantity',
),
)); ?>
