<?php

$this->widget('TbGridView', [
    'id' => 'g-person-status-grid',
    'dataProvider' => gPersonStatus::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'start_date',
        'end_date',
        [
            'header' => 'Status',
            'value' => '$data->status->name',
        ],
        'remark',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteStatus",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPerson/updateStatus',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Status',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            'visible' => ($this->id == "gPerson" && in_array($model->mCompanyId(), sUser::model()->getMyGroupArray()) || Yii::app()->user->name == "admin")
        ],
    ],
]);

