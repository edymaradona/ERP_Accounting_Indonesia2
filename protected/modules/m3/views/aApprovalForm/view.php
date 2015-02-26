<?php
$this->breadcrumbs = [
    'Purchase Order with Dept' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/m3/aApprovalForm']],
];

$this->menu1 = aPorder::getTopUpdated();
$this->menu2 = aPorder::getTopCreated();
?>

<div class="page-header">
    <h1>
        <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/payment.png') ?>
        Approval Form
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
            'template' => '{payment}',
            'buttons' => [
                'payment' => [
                    'label' => 'Paid',
                    'url' => 'Yii::app()->createUrl("/m3/aApprovalForm/updateDetailPaid", array("id"=>$data->id))',
                    'visible' => '$data->detail_payment_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
														$.fn.yiiGridView.update("aPorder-detail-grid", {
														data: $(this).serialize()
});
}',
                        ],
                    ],
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
        [
            'header' => 'Payment',
            'value' => '$data->payment->name',
        ],
    ],
]);
?>
<br/>
<b> Total: <?php echo $model->sum_pof(); ?>
</b>
