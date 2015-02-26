<br/>

<?php

EQuickDlgs::iframeButton(
    [
        'controllerRoute' => 'm1/gPerformance/createCompetencyProfileAjax',
        'actionParams' => ['id' => $model->id, 'year' => $year],
        'dialogTitle' => 'Create New Competency Profile',
        'dialogWidth' => 800,
        'dialogHeight' => 600,
        'openButtonText' => 'New Competency Profile',
        // 'closeButtonText' => 'Close',
        'closeOnAction' => true, //important to invoke the close action in the actionCreate
        'refreshGridId' => 'g-core-competency-grid4k', //the grid with this id will be refreshed after closing
        'openButtonHtmlOptions' => ['class' => 'pull-right btn btn-primary'],
    ]
);


$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-core-competency-grid4k',
    //'dataProvider'=>$model->search(),
    'dataProvider' => gTalentCompetencyProfile::model()->search($model->id, $year),
    'type' => 'condensed',
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'year',
        //array(
        //	'header'=>'Period',
        //	'value' => '$data->getConvertTalentPeriod($data->period)',
        //),
        //'company_id',
        [
            'header' => 'Competency Profile',
            'value' => '$data->potential_template->aspect',
        ],
        'competency_level',
        'remark',
        [
            'class' => 'booster.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerformance/deleteCompetencyProfile",array("id"=>$data->id))',
        ],
    ],
]);
?>

<?php
//echo $this->renderPartial('_formCompetencyProfile', ['model' => $modelCompetencyProfile, 'id' => $model->id, 'year' => $year]);
