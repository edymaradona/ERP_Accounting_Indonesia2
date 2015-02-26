<?php

$this->widget('TbGridView', [
    'id' => 'g-person-experience-grid' . $data->applicant_id,
    'dataProvider' => hApplicantExperience::model()->search($data->applicant_id),
    'enableSorting' => false,
    'template' => '{items}',
    'htmlOptions' => [
        'style' => 'padding-top:0',
    ],
    'type' => 'striped condensed',
    'columns' => [
        'company_name',
        'industries',
        'start_date',
        'end_date',
        'job_title',
    ],
]);

