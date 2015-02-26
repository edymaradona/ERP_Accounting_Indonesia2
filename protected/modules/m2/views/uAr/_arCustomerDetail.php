<?php

if ($model->so = !null) {
    $this->widget('booster.widgets.TbGridView', [
        'id' => 'u-so-grid',
        'dataProvider' => uSo::model()->arCustomerView($model->id),
        //'filter'=>$model,
        'columns' => [
            'input_date',
            'system_ref',
            'remark',
            [
                'header' => 'Total SO',
                'value' => 'peterFunc::indoFormat($data->soSum)',
                'htmlOptions' => [
                    'style' => 'text-align: right; padding-right: 5px;'
                ],
            ],
            [
                'header' => 'Total Payment',
                'value' => '(isset($data->ar)) ? peterFunc::indoFormat($data->ar->paymentSum) : ""',
                'htmlOptions' => [
                    'style' => 'text-align: right; padding-right: 5px;'
                ],
            ],
            [
                'header' => 'Status',
                'type' => 'raw',
                'value' => '
				CHtml::tag("span", array("class" => "label label-info"), (isset($data->ar) && $data->soSum <= $data->ar->paymentSum) ? "Paid" : "Out Standing")',
            ],
        ],
    ]);
} else
    echo "No Sales Order";
?>