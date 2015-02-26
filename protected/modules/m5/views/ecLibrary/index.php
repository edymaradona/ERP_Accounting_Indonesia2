<?php
$this->breadcrumbs=array(
	'Ec Libraries'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'Create','url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Library Roles')),
);

?>

<div class="page-header">
    <h1>
        <i class="fa fa-book fa-fw"></i>
        Book Database
    </h1>
</div>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'ec-library-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		array(
			'name'=>'title',
            'type' => 'raw',
            'value' => function ($data) {
                    return CHtml::link($data->title,$this->createUrl('/m5/ecLibrary/view',['id'=>$data->id])) . " <br/>" . $data->code;
                },
		),
		//'code',
		'description',
		array(
			'name'=>'category_id',
			'value'=>'$data->category->name',
			'filter'=>false
		),
		//'location',
		//'quantity',
array(
'class'=>'booster.widgets.TbButtonColumn',
'template'=>'{update}{delete}',
'visible'=>Yii::app()->user->checkAccess('Library Roles')
),
),
)); ?>
