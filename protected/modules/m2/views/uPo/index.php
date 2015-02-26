<?php
$this->breadcrumbs = [
    'U Sos' => ['index'],
    'Manage',
];


$this->menu = [
    //array('label'=>'Home','icon'=>'home', url'=>array('/m2/uPo')),
];

$this->menu5 = ['Purchased Order'];

$this->menu1 = uPo::getTopUpdated();
$this->menu2 = uPo::getTopCreated();

//$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m2/uPo/index'));
?>


<div class="page-header">
    <h1>Purchased Order</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'New Entry', 'url' => Yii::app()->createUrl('/m2/uPo'), 'active' => true],
        ['label' => 'Delivered', 'url' => Yii::app()->createUrl('/m2/uPo/onDelivered')],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uPo/onHalfPaid')],
        ['label' => 'Full Paid', 'url' => Yii::app()->createUrl('/m2/uPo/onPaid')],
    ],
]);
?>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-so-grid',
    'dataProvider' => uPo::model()->newEntry(),
    //'filter'=>$model,
    'columns' => [
        [
            'name' => 'system_ref',
            'type' => 'raw',
            'value' => 'CHtml::link($data->system_ref,Yii::app()->createUrl("/m2/uPo/view",array("id"=>$data->id)))'
        ],
        'input_date',
        //'entity.name',
        [
            'header' => 'Supplier',
            'name' => 'supplier.company_name',
        ],
        'so_type_id',
        'remark',
        [
            'class' => 'booster.widgets.TbButtonColumn',
            'template' => '{update}{delete}',
        ],
        [
            'header' => 'Status',
            'type' => 'raw',
            'value' => '(isset($data->ap)) ? CHtml::tag("span", array("style" => "font-size:inherit", "class" => "label label-info"), "Locked"): ""',
        ],
        [
            'name' => 'poDetail.amount',
            'value' => 'peterFunc::indoFormat($data->poSum)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'type' => 'raw',
            'value' => '($data->state_id == 1) ?
					CHtml::link("Mark as Delivered",Yii::app()->createUrl("/m2/uPo/toDelivered",array("id"=>$data->id)),array("class"=>"btn btn-mini btn-primary")) : 
		            CHtml::tag("span", array("class" => "label label-info"), "Delivered");
			',
        ]
    ],
]);
?>

