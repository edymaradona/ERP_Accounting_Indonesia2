<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 't-account-grid',
    'dataProvider' => sUser::model()->searchEntity($model->id),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => [
        [
            'header' => 'Full Name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->fullname2,Yii::app()->createUrl("/sUser/view",array("id"=>$data->id)))',
        ],
        'username',
        [
            'header' => 'Status',
            'value' => '$data->status->name',
        ],
    ],
]);

