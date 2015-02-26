<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'gperson-education-nf-grid',
    'dataProvider' => gPersonEducationNf::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'education_name',
        'category',
        'start',
        'end',
        'sertificate:boolean',
        'country',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteEducationNf",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPerson/updateEducationNf',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Non Formal Education',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            'visible' => ($this->id == "gPerson")
        ],
    ],
]);

