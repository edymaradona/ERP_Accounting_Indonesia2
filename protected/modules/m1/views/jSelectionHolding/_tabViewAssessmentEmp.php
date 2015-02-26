<?php

$this->widget('TbGridView', [
    'id' => 'j-selection-grid2',
    'dataProvider' => jSelectionPart::model()->search($model->id),
    //'filter'=>$model,
    'columns' => [
        [
            'value' => 'CHtml::link($data->employee->employee_name,Yii::app()->createUrl("m1/hApplicant/viewEmp",array("id"=>$data->applicant_id)))',
            'type' => 'raw',
            'header' => 'Employee Name',
        ],
        [
            'name' => 'applicant.selection.workflow_by',
            'header' => 'Last Assessment By',
        ],
        [
            'name' => 'applicant.selection.assessment_date',
            'header' => 'Last Assessment Date',
        ],
        [
            'name' => 'applicant.selection.assessment_summary',
            'header' => 'Last Assessment Summary',
        ],
        [
            'name' => 'applicant.selection.development_area',
            'header' => 'Last Development Area',
        ],
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}',
            'updateDialog' => [
                'controllerRoute' => 'm1/jSelectionHolding/updateAssessment',
                'actionParams' => ['id' => '$data->applicant_id'],
                'dialogTitle' => 'New Assessment',
                'dialogWidth' => 600, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
    ],
]);
