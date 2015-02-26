<?php
$this->breadcrumbs = [
    'U Ars' => ['index'],
    'Manage',
];


$this->menu = [
    ['label' => 'AP Dashboard', 'icon' => 'home', 'url' => ['/m2/uAp']],
];
?>


<div class="page-header">
    <h1>AP per Supplier</h1>
</div>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-so-grid',
    'dataProvider' => uSupplier::model()->apSupplier(),
    //'filter'=>$model,
    'columns' => [
        [
            'name' => 'company_name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->company_name,Yii::app()->createUrl("/m2/uAp/apSupplierView",array("id"=>$data->id)))',
        ],
        'pic',
        'telephone',
        [
            'header' => 'Total Puchased',
            'value' => 'peterFunc::indoFormat($data->po)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Total Payment',
            'value' => 'peterFunc::indoFormat($data->poPayment)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Balance',
            'value' => 'peterFunc::indoFormat($data->po - $data->poPayment)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
    ],
]);
?>

