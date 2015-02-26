<?php

$this->widget('TbGridView', [
    'id' => 'g-person-experience-grid',
    'dataProvider' => gPersonExperience::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'company_name',
        'industries',
        'start_date',
        'end_date',
        'year_length',
        'month_length',
        'job_title',
        //array(
        //	'class'=>'TbButtonColumn',
        //	'template'=>'{delete}',
        //	'deleteButtonUrl'=>'Yii::app()->createUrl("m1/gPerson/deleteExperience",array("id"=>$data->id))',
        //),
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteExperience",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPerson/updateExperience',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Experience',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            'visible' => ($this->id == "gPerson")
        ],
    ],
]);


