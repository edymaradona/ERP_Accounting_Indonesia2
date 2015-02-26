<?php
$this->breadcrumbs = [
    'U Ars' => ['index'],
    'Manage',
];


$this->menu = [
    //array('label'=>'List uAr','url'=>array('index')),
    //array('label'=>'Create uAr','url'=>array('create')),
];

$this->menu5 = ['Sales Order'];

$this->menu1 = uSo::getTopUpdated();
$this->menu2 = uSo::getTopCreated();

//$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m2/uSo/index'));
?>


<div class="page-header">
    <h1>Sales Order: Half Paid</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'New Entry', 'url' => Yii::app()->createUrl('/m2/uSo')],
        ['label' => 'Delivered', 'url' => Yii::app()->createUrl('/m2/uSo/onDelivered')],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uSo/onHalfPaid'), 'active' => true],
        ['label' => 'Full Paid', 'url' => Yii::app()->createUrl('/m2/uSo/onPaid')],
    ],
]);
?>



<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-ar-grid',
    'dataProvider' => uAr::model()->onHalfPaid(),
    //'filter'=>$model,
    'columns' => [
        //'entity_id',
        //'periode_date',
        //'ar_type_id',
        [
            'name' => 'so.system_ref',
            'type' => 'raw',
            'value' => 'CHtml::link($data->so->system_ref,Yii::app()->createUrl("/m2/uAr/view",array("id"=>$data->id)))'
        ],
        'so.input_date',
        //'entity.name',
        [
            'header' => 'Customer',
            'name' => 'so.customer.company_name',
        ],
        //'so.so_type_id',
        //'so.remark',
        'remark',
        [
            'name' => 'soDetail.amount',
            'value' => 'peterFunc::indoFormat($data->so->soSum)',
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

