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
    <h1>Sales Order: Delivered</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'New Entry', 'url' => Yii::app()->createUrl('/m2/uSo')],
        ['label' => 'Delivered', 'url' => Yii::app()->createUrl('/m2/uSo/onDelivered'), 'active' => true],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uSo/onHalfPaid')],
        ['label' => 'Full Paid', 'url' => Yii::app()->createUrl('/m2/uSo/onPaid')],
    ],
]);
?>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-so-grid',
    'dataProvider' => uSo::model()->newSo(),
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
            'name' => 'soDetail.amount',
            'value' => 'peterFunc::indoFormat($data->soSum)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'class' => 'booster.widgets.TbButtonColumn',
            'template' => '{delete}',
        ],
        //array(
        //	'header'=>'Status',
        //	'type'=>'raw',
        //	'value'=>'(isset($data->ar)) ? CHtml::tag("span", array("style" => "font-size:inherit", "class" => "label label-info"), "Locked"): ""',
        //),
    ],
]);
?>

