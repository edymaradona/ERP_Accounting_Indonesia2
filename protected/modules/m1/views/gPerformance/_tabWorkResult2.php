<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-work-result-grid4',
    //'dataProvider'=>$model->search(),
    'dataProvider' => gTalentWorkResult::model()->search($model->id, $year),
    'type' => 'condensed',
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'year',
        //array(
        //	'header'=>'Period',
        //	'value' => '$data->getConvertTalentPeriod($data->period)',
        //),
        //'company_id',
        'talent_template.aspect',
        'talent_template.weight',
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'personal_score',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateWorkResultAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'superior_score',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateWorkResultAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        'calcFinalResult',
        'remark',
        [
            'header' => 'Created Date/By',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->created->username
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], date('d-m-Y', ($data->created_date)));
                }
        ],
        [
            'header' => 'Updated Date/By',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->updated->username
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], date('d-m-Y', ($data->updated_date)));
                }
        ],

    ],
]);

