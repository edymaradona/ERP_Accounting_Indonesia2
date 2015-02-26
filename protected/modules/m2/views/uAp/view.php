<?php
$this->breadcrumbs = [
    'U Ars' => ['index'],
    $model->id,
];


$this->menu = [
    ['label' => 'AP Dashboard', 'icon' => 'home', 'url' => ['/m2/uAp']],
    ['label' => 'AP Supplier', 'icon' => 'home', 'url' => ['/m2/uAp/apSupplier']],
];
?>


    <div class="page-header">
        <h1><?php echo $model->po->system_ref; ?></h1>
    </div>


<?php
$this->widget('booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        //'entity.name',
        'so.input_date',
        [
            'label' => 'Supplier',
            'type' => 'raw',
            'value' => CHtml::link($model->po->supplier->company_name, Yii::app()->createUrl("/m2/uAp/apSupplier", ["id" => $model->po->supplier_id])),
        ],
        [
            'name' => 'total_amount',
            'value' => peterFunc::indoFormat($model->total_amount),
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        'remark',
    ],
]);
?>

<?php
echo $this->renderPartial('_paymentHistory', ['model' => $model]);

if ($model->total_amount > $model->paymentSum)
    echo $this->renderPartial('_formPayment', ['model' => $modelPayment]);
?>