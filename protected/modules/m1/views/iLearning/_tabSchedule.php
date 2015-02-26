<?php

$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 'i-learning-sch-grid',
    'dataProvider' => iLearningSch::model()->search($model->id),
    'columns' => [
        [
            'name' => 'schedule_date',
            'type' => 'raw',
            'value' => 'CHtml::link($data->schedule_date,Yii::app()->createUrl("/m1/iLearning/viewDetail",array("id"=>$data->id)))',
        ],
        'trainer_name',
        'location',
        'additional_info',
        //array(
        //	'class'=>'TbButtonColumn',
        //	'template'=>'{update}{delete}',
        //),
        [
            'name' => 'status_id',
            'value' => '$data->status->name',
        ],
    ],
]);
