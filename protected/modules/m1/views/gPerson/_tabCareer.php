<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-karir-grid',
    'dataProvider' => gPersonCareer::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'header' => 'Start / Site Date',
            'type' => 'raw',
            'value' => function ($data) {
                    return peterFunc::issetC($data->start_date)
                    . "<br/>" . peterFunc::issetC($data->custom1_date);
                },
        ],
        [
            'header' => 'Status / Level',
            'type' => 'raw',
            'value' => 'peterFunc::issetC($data->status->name). "<br/>".peterFunc::issetC($data->level->name)',
        ],
        [
            'header' => 'Company / Dept / Job Title',
            'type' => 'raw',
            'value' => function ($data) {
                    return peterFunc::issetC($data->company->name)
                    . "<br/>" . peterFunc::issetC($data->department->name)
                    . " - " . $data->job_title;
                },
        ],
        [
            'header' => 'Superior',
            'type' => 'raw',
            'value' => function ($data) { return isset($data->superior) ? CHtml::link($data->superior->employee_name,Yii::app()->createUrl("/m1/gPerson/view",["id"=>$data->superior_id])) : ""; },
        ],
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteCareer",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPerson/updateCareer',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Career',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            'visible' => ($this->id == "gPerson" && in_array($model->mCompanyId(), sUser::model()->getMyGroupArray()) || Yii::app()->user->name == "admin")
        ],
    ],
]);
