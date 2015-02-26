<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-education-grid',
    'dataProvider' => gPersonEducation::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
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
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteEducation",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPerson/updateEducation',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Education',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            'visible' => ($this->id == "gPerson")
        ],
    ],
]);
