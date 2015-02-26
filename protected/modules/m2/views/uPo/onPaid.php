<?php
$this->breadcrumbs = [
    'U Ars' => ['index'],
    'Manage',
];


$this->menu = [
    //array('label'=>'List uAp','url'=>array('index')),
];

$this->menu5 = ['Purchased Order'];

$this->menu1 = uPo::getTopUpdated();
$this->menu2 = uPo::getTopCreated();

//$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m2/uPo/index'));
?>


<div class="page-header">
    <h1>Purchased Order: Paid</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'New Entry', 'url' => Yii::app()->createUrl('/m2/uPo')],
        ['label' => 'Delivered', 'url' => Yii::app()->createUrl('/m2/uPo/onDelivered')],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uPo/onHalfPaid')],
        ['label' => 'Full Paid', 'url' => Yii::app()->createUrl('/m2/uPo/onPaid'), 'active' => true],
    ],
]);
?>



<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-ar-grid',
    'dataProvider' => uAp::model()->onPaid(),
    //'filter'=>$model,
    'columns' => [
        //'entity_id',
        //'periode_date',
        //'ar_type_id',
        [
            'name' => 'po.system_ref',
            'type' => 'raw',
            'value' => 'CHtml::link($data->po->system_ref,Yii::app()->createUrl("/m2/uPo/view",array("id"=>$data->id)))'
        ],
        'po.input_date',
        //'entity.name',
        [
            'header' => 'Supplier',
            'name' => 'po.supplier.company_name',
        ],
        //'po.po_type_id',
        'remark',
        [
            'name' => 'poDetail.amount',
            'value' => 'peterFunc::indoFormat($data->po->poSum)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Total Paid',
            'value' => 'peterFunc::indoFormat($data->paymentSum)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
    ],
]);
?>

