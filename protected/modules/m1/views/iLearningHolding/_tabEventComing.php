<?php

$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 'i-learning-sch-grid4',
    'dataProvider' => iLearningSch::model()->searchByDate(),
    //'filter'=>$model,
    'columns' => [
        [
            'name' => 'schedule_date',
            'type' => 'raw',
            'value' => 'CHtml::link($data->schedule_date,Yii::app()->createUrl("/m1/iLearningHolding/viewDetail",array("id"=>$data->id)))',
        ],
        [
            'header' => 'Subject',
            'type' => 'raw',
            'value' => 'CHtml::link($data->getparent->learning_title,Yii::app()->createUrl("/m1/iLearningHolding/view",array("id"=>$data->parent_id)))',
        ],
        'trainer_name',
        'location',
        'additional_info',
        [
            'name' => 'status_id',
            'value' => '$data->status->name',
        ],
        [
            'name' => 'partCount',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        //array(
        //	'class'=>'CButtonColumn',
        //),
    ],
]);
