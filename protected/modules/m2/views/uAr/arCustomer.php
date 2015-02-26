<?php
$this->breadcrumbs = [
    'U Ars' => ['index'],
    'Manage',
];


$this->menu = [
    ['label' => 'AR Dashboard', 'icon' => 'home', 'url' => ['/m2/uAr']],
];
?>


<div class="page-header">
    <h1>AR per Customer</h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbGridView', [
    'id' => 'u-so-grid',
    'dataProvider' => uCustomer::model()->arCustomer(),
    //'filter'=>$model,
    'columns' => [
        [
            'name' => 'company_name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->company_name,Yii::app()->createUrl("/m2/uAr/arCustomerView",array("id"=>$data->id)))',
        ],
        'pic',
        'telephone',
        [
            'header' => 'Total Sales',
            'value' => 'peterFunc::indoFormat($data->so)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Total Payment',
            'value' => 'peterFunc::indoFormat($data->soPayment)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Balance',
            'value' => 'peterFunc::indoFormat($data->so - $data->soPayment)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
    ],
]);
?>

