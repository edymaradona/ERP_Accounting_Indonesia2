<?php
$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 'i-learning-sch-grid',
    'dataProvider' => iLearningSch::model()->search($model->id),
    'columns' => [
        [
            'name' => 'schedule_date',
            'type' => 'raw',
            'value' => 'CHtml::link($data->schedule_date,Yii::app()->createUrl("/m1/iLearningHolding/viewDetail",array("id"=>$data->id)))',
        ],
        'trainer_name',
        'location',
        'additional_info',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/iLearningHolding/deleteSchedule",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/iLearningHolding/updateSchedule',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Schedule',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'status_id',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => [
                'url' => $this->createUrl('/m1/iLearningHolding/updateMandaysAjax'),
                'type' => 'select',
                'source' => sParameter::items("cTrainingStatus"),
            ]
        ],
        //'status.name',
        'actual_mandays'
    ],
]);
?>

    <div class="page-header">
        <h3>New Schedule</h3>
    </div>

<?php
echo $this->renderPartial('_formSchedule', ['model' => $modelSchedule]);
