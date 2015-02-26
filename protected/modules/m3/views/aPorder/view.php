<?php
$this->breadcrumbs = [
    'Purchase Order with Dept' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/m3/aPorder']],
    ['label' => 'Update', 'url' => ['update', 'id' => $model->id]],
];

$this->menu1 = aPorder::getTopUpdated();
$this->menu2 = aPorder::getTopCreated();
?>

<div class="page-header">
    <h1>
        <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/cash.png') ?>
        <?php echo "PO: " . $model->no_ref; ?>
    </h1>
</div>

<?php
//----- begin new code --------------------
if (empty($_GET['asDialog'])) {
    //$this->widget('booster.widgets.TbDetailView', array(
    $this->widget('ext.XDetailView', [
        'ItemColumns' => 2,
        'data' => $model,
        'attributes' => [
            [
                'label' => 'Entity',
                'value' => $model->organization->name,
            ],
            'input_date',
            'af_date',
            'no_ref',
            'periode_date',
            [
                'label' => 'Budget Component',
                'value' => $model->budgetcomp->name,
            ],
            'approved_date',
            'remark',
            [
                'label' => 'Issued By',
                'value' => $model->issuer->name,
            ],
            [
                'label' => 'Payment Status',
                'value' => $model->payment->name,
            ],
            'payment_date',
        ],
    ]);
}
//----- end new code --------------------
?>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'aPorder-detail-grid',
    'dataProvider' => aPorderDetail::model()->search($_GET['id']),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    //'filter'=>$model,
    'columns' => [
        [
            'class' => 'TbButtonColumn',
            'template' => '{my_delete}',
            'buttons' => [
                'my_delete' => [
                    'label' => '<i class="icon-fa-trash"></i',
                    'url' => 'Yii::app()->createUrl("/m3/aPorder/deleteDetail", array("id"=>$data->id))',
                    'visible' => '$data->po->approved_date == null',
                ],
            ],
        ],
        [
            'header' => 'Department',
            'value' => 'isset($data->department) ? $data->department->name : "ALL"',
        ],
        [
            'header' => 'Budget SubComp.',
            'value' => '$data->budget->code .". ".$data->budget->name',
        ],
        //'supplier.company_name',
        'description',
        //'user',
        //'qty',
        //'uom',
        [
            'value' => '$data->amountf()',
            'name' => 'amount',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Total',
            'value' => '$data->totalf()',
            'name' => 'amount',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
    ],
]);
?>
<br/>
<b> Total: <?php echo $model->sum_pof(); ?>
</b>
