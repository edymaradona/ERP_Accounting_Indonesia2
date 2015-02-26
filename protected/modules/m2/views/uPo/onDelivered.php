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
    <h1>Purchased Order: Delivered</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'New Entry', 'url' => Yii::app()->createUrl('/m2/uPo')],
        ['label' => 'Delivered', 'url' => Yii::app()->createUrl('/m2/uPo/onDelivered'), 'active' => true],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uPo/onHalfPaid')],
        ['label' => 'Full Paid', 'url' => Yii::app()->createUrl('/m2/uPo/onPaid')],
    ],
]);
?>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-so-grid',
    'dataProvider' => uPo::model()->newPo(),
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
        'po_type_id',
        'remark',
        [
            'name' => 'poDetail.amount',
            'value' => 'peterFunc::indoFormat($data->poSum)',
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
        //	'value'=>'(isset($data->ap)) ? CHtml::tag("span", array("style" => "font-size:inherit", "class" => "label label-info"), "Locked"): ""',
        //),
    ],
]);
?>

