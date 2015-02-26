<?php

$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 'i-learning-sch-grid1',
    'dataProvider' => iLearningSch::model()->search($model->id, true),
    //'filter'=>$model,
    'columns' => [
        [
            'name' => 'schedule_date',
            'type' => 'raw',
            'value' => 'CHtml::link($data->schedule_date,Yii::app()->createUrl("/m1/iLearningHolding/viewDetail",array("id"=>$data->id)))',
        ],
        'trainer_name',
        'location',
        'additional_info',
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'status_id',
            //we need not to set value, it will be auto-taken from source
            // 'headerHtmlOptions' => array('style' => 'width: 60px'),
            'editable' => [
                'type' => 'select2',
                'url' => $this->createUrl('/m1/iLearningHolding/updateMandaysAjax'),
                'source' => sParameter::items('cTrainingStatus'),
            ]
        ],
        [
            'name' => 'partCount',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'actual_mandays',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/iLearningHolding/updateMandaysAjax'),
                //'placement' => 'right',
            ]
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'certificate_template_id',
            //we need not to set value, it will be auto-taken from source
            // 'headerHtmlOptions' => array('style' => 'width: 60px'),
            'editable' => [
                'type' => 'select2',
                'url' => $this->createUrl('/m1/iLearningHolding/updateMandaysAjax'),
                'source' => ['0' => 'Non Certificate', '1' => 'Template 1', '2' => 'Template 2', '3' => 'Template 3'],
            ]
        ],
        [
            'class' => 'ext.booster.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/iLearningHolding/deleteSchedule",array("id"=>$data->id))',
        ],
    ],
]);

