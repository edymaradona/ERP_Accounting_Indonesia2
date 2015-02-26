<?php

$this->widget('TbGridView', [
    'id' => 'g-vacancy-campaign-grid',
    'dataProvider' => hVacancyCampaign::model()->search($model->id),
    //'filter'=>$model,
    'type' => 'striped bordered condensed',
    'template' => '{items}',
    'columns' => [
        'campaign_name',
        'start_date',
        'end_date',
        'location',
        'additional_info',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteCampaign",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/hVacancy/updateCampaign',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Campaign',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
    ],
]);
