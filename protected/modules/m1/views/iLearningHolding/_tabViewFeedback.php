<?php

$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 'i-learning-sch-part-grid1',
    'dataProvider' => iLearningSchPart::model()->searchHolding($model->id),
    //'filter'=>$model,
    'columns' => [
        [
            'header' => '#No.',
            'value' => '$row+1',
            'htmlOptions' => [
                'style' => 'text-align:right;margin-right:5px',
            ],
        ],
        [
            'type' => 'raw',
            'value' => '$data->employee->PhotoPath',
            'htmlOptions' => [

            ],
        ],
        [
            'header' => 'Employee Name',
            'type' => 'raw',
            'value' => function ($data) {
                    return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->employee->employee_name)
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->employee->mCompany())
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->employee->mDepartment())
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->employee->mLevel());
                },
        ],
        [
            'header' => 'Comment',
            'value' => 'isset($data->feedback->D1) ? $data->feedback->D1 : ""',
        ],
        [
            'header' => 'Feedback',
            'value' => 'isset($data->feedback->D2) ? $data->feedback->D2 : ""',
        ],
    ],
]);
