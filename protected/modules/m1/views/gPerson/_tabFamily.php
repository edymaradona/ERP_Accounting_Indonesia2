<?php

$this->widget('TbGridView', [
    'id' => 'g-person-family-grid',
    'dataProvider' => gPersonFamily::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'f_name',
        [
            'header' => 'Relation',
            'value' => '$data->relation->name',
        ],
        'birth_place',
        'birth_date',
        [
            'header' => 'Sex',
            'value' => '$data->sex->name',
        ],
        'remark',
        [
            'header' => 'Medical Cover',
            'value' => '$data->medical_cover->name',
        ],
        'insurance_number',
        //array(
        //	'class'=>'TbButtonColumn',
        //	'template'=>'{delete}',
        //	'deleteButtonUrl'=>'Yii::app()->createUrl("m1/gPerson/deleteFamily",array("id"=>$data->id))',
        //),
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteFamily",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPerson/updateFamily',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Family',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            'visible' => ($this->id == "gPerson")
        ],
    ],
]);
