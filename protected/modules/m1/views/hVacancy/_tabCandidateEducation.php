<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-education-grid' . $data->applicant_id,
    'dataProvider' => hApplicantEducation::model()->search($data->applicant_id),
    //'filter'=>$model,
    'enableSorting' => false,
    'template' => '{items}',
    'htmlOptions' => [
        'style' => 'padding-top:0',
    ],
    'type' => 'striped condensed',
    'columns' => [
        [
            'header' => 'Level',
            'value' => '$data->edulevel->name',
        ],
        'school_name',
        'city',
        'interest',
        'graduate',
        //'country',
        //'institution',
        'ipk',
    ],
]);
