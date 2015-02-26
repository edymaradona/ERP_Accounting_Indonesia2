<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'gperson-training-holding-grid',
    'dataProvider' => iLearningSchPart::model()->searchByEmployee($model->id),
    //'filter'=>$model,
    'template' => '{items}{pager}',
    'htmlOptions' => [
        'style' => 'padding-top:0'
    ],
    'columns' => [
        'getparent.getparent.learning_title',
        'getparent.schedule_date',
        'getparent.trainer_name',
        'getparent.getparent.duration',
        'getparent.location',
        'resultFeedback',
    ],
]);


