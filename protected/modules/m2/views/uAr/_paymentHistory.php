<h4>Payment History</h4>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 't-account-balance-grid',
    'dataProvider' => uArPayment::model()->search($model->id),
    'template' => '{items}{pager}',
    'itemsCssClass' => 'table table-striped table-bordered',
    'columns' => [
        'payment_date',
        [
            'header' => 'No Ref',
            'value' => '$data->payment_ref',
        ],
        [
            'header' => 'Payment Type',
            'value' => '($data->payment_type_id == 1) ? "Cash" : "Cheque/Giro"',
        ],
        [
            'header' => 'Payment Target',
            'value' => '$data->payment_target->account_concat',
        ],
        [
            'header' => 'Effective Date',
            'value' => '$data->effective_date',
        ],
        [
            'class' => 'ext.gridcolumns.TotalColumn',
            'name' => 'amount',
            'output' => 'peterFunc::indoFormat($value)',
            'type' => 'raw',
            'footer' => true,
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
            'footerHtmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px; font-weight:bold'
            ],
        ],
    ],
]);
?>


