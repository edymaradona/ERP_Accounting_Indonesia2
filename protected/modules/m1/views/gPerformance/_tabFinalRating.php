<br/>

<?php

EQuickDlgs::iframeButton(
    [
        'controllerRoute' => 'm1/gPerformance/createFinalRatingAjax',
        'actionParams' => ['id' => $model->id],
        'dialogTitle' => 'Create New Final Rating',
        'dialogWidth' => 800,
        'dialogHeight' => 600,
        'openButtonText' => 'New Final Rating',
        // 'closeButtonText' => 'Close',
        'closeOnAction' => true, //important to invoke the close action in the actionCreate
        'refreshGridId' => 'g-performance-grid', //the grid with this id will be refreshed after closing
        'openButtonHtmlOptions' => ['class' => 'pull-right btn btn-primary'],
    ]
);

$this->widget('TbGridView', [
    'id' => 'g-performance-grid',
    'dataProvider' => gTalentPerformance::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'year',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateFinalRatingAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'period_id',
            //we need not to set value, it will be auto-taken from source
            // 'headerHtmlOptions' => array('style' => 'width: 60px'),
            'editable' => [
                'type' => 'select2',
                'url' => $this->createUrl('/m1/gPerformance/updateFinalRatingAjax'),
                'source' => sParameter::items('cSemester'),
            ]
        ],
        //'amount',
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'pa_value',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateFinalRatingAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'potential',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateFinalRatingAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        //'future_dev',
        //array(
        //    'header' => 'Performance Value',
        //    'value' => '$data->valPerformance()',
        //),
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'remark',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateFinalRatingAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerformance/deletePerformance",array("id"=>$data->id))',
            'visible' => ($this->id == "gPerformance"),
        ],
        [
            'header' => 'Created Date/By',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->created->username
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], date('d-m-Y', ($data->created_date)));
                }
        ],
        [
            'header' => 'Updated Date/By',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->updated->username
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], date('d-m-Y', ($data->updated_date)));
                }
        ],
    ],
]);
?>

<?php
//if (isset($modelPerformanceR))
//    echo $this->renderPartial('_formFinalRating', ['model' => $modelPerformanceR]);