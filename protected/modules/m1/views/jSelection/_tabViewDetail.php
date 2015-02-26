<?php

$this->widget('TbGridView', [
    'id' => 'j-selection-grid',
    'dataProvider' => jSelectionPart::model()->search($model->id),
    //'filter'=>$model,
    'columns' => [
        [
            'value' => 'CHtml::link($data->applicant->applicant_name,Yii::app()->createUrl("m1/hApplicant/view",array("id"=>$data->applicant_id)))',
            'type' => 'raw',
            'header' => 'Applicant Name',
        ],
        [
            'name' => 'company.name',
            'header' => 'Company',
        ],
        [
            'name' => 'department.name',
            'header' => 'Department',
        ],
        [
            'name' => 'level.name',
            'header' => 'Level',
        ],
        'for_position',
        [
            'name' => 'flow.name',
            'header' => 'Status',
        ],
        'remark',
        //array(
        //	'class'=>'TbButtonColumn',
        //	'template'=>'{delete}',
        //	'deleteButtonUrl'=>'Yii::app()->createUrl("/m1/jSelectionHolding/deleteParticipant",array("id"=>$data->id))',
        //),
        //array(
        //	'name'=>'created.username',
        //	'header'=>'Created By',
        //),
    ],
]);
