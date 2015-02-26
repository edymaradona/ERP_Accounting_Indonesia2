<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'gperson-training-nf-grid',
    'dataProvider' => gPersonTraining::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => [
        'style' => 'padding-top:0'
    ],
    'columns' => [
        'start_date',
        'type.name',
        'topic',
        'instructor',
        'duration',
        'sertificate:boolean',
        'organizer',
        'place',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteTraining",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPerson/updateTraining',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Training',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            'visible' => ($this->id == "gPerson")
        ],
    ],
]);

