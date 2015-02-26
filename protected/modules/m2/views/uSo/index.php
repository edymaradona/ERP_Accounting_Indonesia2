<?php
$this->breadcrumbs = [
    'U Sos' => ['index'],
    'Manage',
];


$this->menu = [
    //array('label'=>'Home','icon'=>'home', url'=>array('/m2/uSo')),
];

$this->menu5 = ['Sales Order'];

$this->menu1 = uSo::getTopUpdated();
$this->menu2 = uSo::getTopCreated();

//$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m2/uSo/index'));
?>


<div class="page-header">
    <h1>Sales Order</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'New Entry', 'url' => Yii::app()->createUrl('/m2/uSo'), 'active' => true],
        ['label' => 'Delivered', 'url' => Yii::app()->createUrl('/m2/uSo/onDelivered')],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uSo/onHalfPaid')],
        ['label' => 'Full Paid', 'url' => Yii::app()->createUrl('/m2/uSo/onPaid')],
    ],
]);
?>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-so-grid',
    'dataProvider' => uSo::model()->newEntry(),
    //'filter'=>$model,
    'columns' => [
        [
            'name' => 'system_ref',
            'type' => 'raw',
            'value' => 'CHtml::link($data->system_ref,Yii::app()->createUrl("/m2/uSo/view",array("id"=>$data->id)))'
        ],
        'input_date',
        //'entity.name',
        [
            'header' => 'Customer',
            'name' => 'customer.company_name',
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
            'value' => '(isset($data->ar)) ? CHtml::tag("span", array("style" => "font-size:inherit", "class" => "label label-info"), "Locked"): ""',
        ],
        [
            'name' => 'soDetail.amount',
            'value' => 'peterFunc::indoFormat($data->soSum)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'type' => 'raw',
            'value' => '($data->state_id == 1) ?
					CHtml::link("Mark as Delivered",Yii::app()->createUrl("/m2/uSo/toDelivered",array("id"=>$data->id)),array("class"=>"btn btn-mini btn-primary")) : 
		            CHtml::tag("span", array("class" => "label label-info"), "Delivered");
			',
        ]
    ],
]);
?>

