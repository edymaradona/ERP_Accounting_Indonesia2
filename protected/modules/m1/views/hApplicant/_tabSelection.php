<h4>Application</h4>

<?php
$this->widget('TbGridView', [
    'id' => 'g-vacancy-grid',
    'dataProvider' => hVacancyApplicant::model()->searchByApplicant($model->id),
    //'filter'=>$model,
    'template' => '{items}{pager}',
    'columns' => [
        [
            'header' => 'Apply Date',
            'value' => 'date("d-m-Y",$data->created_date)',
        ],
        [
            'header' => 'Vacancy Title',
            'type' => 'raw',
            'value' => 'CHtml::link($data->vacancy->vacancy_title." - ".$data->vacancy->company->name,Yii::app()->createUrl("/m1/hVacancy/view",array("id"=>$data->vacancy->id))) ',
        ],
        [
            'header' => 'Status',
            'type' => 'raw',
            'value' => '$data->status->name'
        ],
    ],
]);
?>

<h4>Comment</h4>

<?php
$this->widget('TbGridView', [
    'id' => 'g-selection-grid',
    'dataProvider' => hApplicantComment::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}{pager}',
    'columns' => [
        [
            'header' => 'Apply Date',
            'value' => 'date("d-m-Y",$data->created_date)',
        ],
        [
            'header' => 'User',
            'value' => '$data->user->username',
        ],
        'comment',
    ],
]);
?>

<h4>Selection Schedule</h4>

<?php
$this->widget('TbGridView', [
    'id' => 'g-selection-grid',
    'dataProvider' => jSelectionPart::model()->searchByEmp($model->id),
    //'filter'=>$model,
    'template' => '{items}{pager}',
    'columns' => [
        [
            'header' => 'Created',
            'value' => 'date("d-m-Y",$data->created_date)',
        ],
        'company.name',
        'department.name',
        'for_position',
        [
            'header' => 'Level',
            'value' => '$data->level->name',
        ],
    ],
]);
?>

<h4>Selection Result</h4>

<?php
$this->widget('TbGridView', [
    'id' => 'g-selection-grid',
    'dataProvider' => hApplicantSelection::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}{pager}',
    'columns' => [
        //'vacancy.vacancy_title',
        [
            'header' => 'Vacancy',
            'value' => '(isset($data->vacancy)) ? $data->vacancy->vacancy_title : "Non Applied"',
        ],
        'assessment_date',
        [
            'header' => 'Work Flow',
            'value' => '$data->workflow->name',
        ],
        'workflow_by',
        /* array(
          'header' => 'Work Flow Result',
          'value' => '$data->workflow_result_id',
          ), */
        //'assessment_summary',
        //'development_area',
    ],
]);
?>
