<br/>

<?php

EQuickDlgs::iframeButton(
    [
        'controllerRoute' => 'm1/gPerformance/createPotentialAjax',
        'actionParams' => ['id' => $model->id, 'year' => $year],
        'dialogTitle' => 'Create New Potential',
        'dialogWidth' => 800,
        'dialogHeight' => 600,
        'openButtonText' => 'New Potential',
        // 'closeButtonText' => 'Close',
        'closeOnAction' => true, //important to invoke the close action in the actionCreate
        'refreshGridId' => 'g-person-potential-grid', //the grid with this id will be refreshed after closing
        'openButtonHtmlOptions' => ['class' => 'pull-right btn btn-primary'],
    ]
);

$this->widget('TbGridView', [
    'id' => 'g-person-potential-grid',
    'dataProvider' => gTalentPotential::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        //'input_date',
        'year',
        'amount',
        //'proficiency_level',
        [
            'header' => 'Recommendation',
            'value' => '$data->valPotential()',
        ],
        'remark',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerformance/deletePotential",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPerformance/updatePotential',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Potential',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            'visible' => ($this->id == "gPerformance"),
        ],
    ],
]);
?>

<?php
//if (isset($modelPotential))
//    echo $this->renderPartial('_formPotential', ['model' => $modelPotential]);
