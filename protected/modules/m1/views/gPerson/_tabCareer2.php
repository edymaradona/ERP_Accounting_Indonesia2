<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-karir2-grid',
    'dataProvider' => gPersonCareer2::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'start_date',
        'end_date',
        [
            'header' => 'Status',
            'value' => 'peterFunc::issetC($data->status->name)',
        ],
        [
            'header' => 'Company',
            'value' => 'peterFunc::issetC($data->company->name)',
        ],
        [
            'header' => 'Department',
            'value' => 'peterFunc::issetC($data->department->name)',
        ],
        //'department_id',
        [
            'header' => 'Level',
            'value' => 'peterFunc::issetC($data->level->name)',
        ],
        'job_title',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteCareer2",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPerson/updateCareer2',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Career',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            'visible' => ($this->id != "gPerson")
        ],
    ],
]);
