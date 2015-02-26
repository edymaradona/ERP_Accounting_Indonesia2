<?php

if ($model->po = !null) {
    $this->widget('booster.widgets.TbGridView', [
        'id' => 'u-po-grid',
        'dataProvider' => uPo::model()->apSupplierView($model->id),
        //'filter'=>$model,
        'columns' => [
            'input_date',
            'system_ref',
            'remark',
            [
                'header' => 'Total PO',
                'value' => 'peterFunc::indoFormat($data->poSum)',
                'htmlOptions' => [
                    'style' => 'text-align: right; padding-right: 5px;'
                ],
            ],
            [
                'header' => 'Total Payment',
                'value' => '(isset($data->ap)) ? peterFunc::indoFormat($data->ap->paymentSum) : ""',
                'htmlOptions' => [
                    'style' => 'text-align: right; padding-right: 5px;'
                ],
            ],
            [
                'header' => 'Status',
                'type' => 'raw',
                'value' => '
				CHtml::tag("span", array("class" => "label label-info"), (isset($data->ap) && $data->poSum <= $data->ap->paymentSum) ? "Paid" : "Out Standing")',
            ],
        ],
    ]);
} else
    echo "No Purchased Order";
?>