<?php
$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('start_date'),
    'id' => 'g-expense-grid',
    'dataProvider' => gExpense::model()->search($model->id,2),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'header' => 'Start - End Date',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->start_date . " - <br/>" 
                    . $data->end_date . "<br/>" 
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->number_of_day ." day(s)");
                },
            'htmlOptions' => [
                'style' => 'min-width:150px;',
            ],
        ],
        [
            'header' => 'Type - Purpose',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->expense_type->name
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->purpose);
                },
        ],
        [
            'header' => 'Destination / (Advanced / Realization Amount)',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->destination
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], peterFunc::indoFormat($data->original_amount))
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], peterFunc::indoFormat($data->detailC));

                },
        ],
        [
            'header' => 'Superior/ HR Status',
            'type' => 'raw',
            //'value' => '$data->superior_approved->name',
            'value' => function ($data) {
                    return $data->superior_approved->name . " " . CHtml::tag('i', ['style' => 'color: #999; font-size: 12px'], $data->created->username) . "<br/>" .
                    $data->approved->name . " " . CHtml::tag('i', ['style' => 'color: #999; font-size: 12px'], ($data->created_by != $data->updated_by && isset($data->updated->username)) ? $data->updated->username : "");
                },
        ],
        'remark',
        [
            'class' => 'TbButtonColumn',
            'template' => '{print}{verified}',
            'buttons' => [
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/printExpense",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'target' => '_blank',
                    ],
                ],
                'verified' => [
                    'label' => 'Verified Realization',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/viewVerified",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==2',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:3px',
                    ],
                ],
            ],
        ],
    ],
]);

