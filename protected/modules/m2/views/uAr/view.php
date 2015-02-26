<?php
$this->breadcrumbs = [
    'U Ars' => ['index'],
    $model->id,
];


$this->menu = [
    ['label' => 'AR Dashboard', 'icon' => 'home', 'url' => ['/m2/uAr']],
    ['label' => 'AR Customer', 'icon' => 'home', 'url' => ['/m2/uAr/arCustomer']],
];
?>


    <div class="page-header">
        <h1><?php echo $model->so->system_ref; ?></h1>
    </div>


<?php
$this->widget('booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        //'entity.name',
        'so.input_date',
        [
            'label' => 'Customer',
            'type' => 'raw',
            'value' => CHtml::link($model->so->customer->company_name, Yii::app()->createUrl("/m2/uAr/arCustomerView", ["id" => $model->so->customer_id])),
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