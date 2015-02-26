<?php
$this->breadcrumbs = [
    'I Learning Sches' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/m1/iLearning']],
    ['label' => $model->getparent->learning_title, 'url' => ['/m1/iLearning/view', 'id' => $model->parent_id]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

<div class="page-header">
    <h1><i class="fa fa-book fa-fw"></i>
        <?php echo $model->getparent->learning_title; ?> | <?php echo $model->schedule_date ?></h1>
</div>

<?php
$this->widget('ext.booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        'getparent.objective',
        'getparent.outline',
        'getparent.participant',
        'getparent.duration',
        [
            'name' => 'getparent.type_id',
            'value' => $model->getparent->type->name,
        ],
    ],
]);
?>
<br/>

<?php
$this->widget('ext.booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        'trainer_name',
        'location',
        'schedule_date',
        'additional_info',
        [
            'name' => 'status_id',
            'value' => $model->status->name,
        ],
    ],
]);
?>

<br/>

<div class="row">
    <div class="col-md-4">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php echo $model->partCount ?></h3>
            <h6><span style="color:#999">Total Participant (Max 35)</span></h6>
        </div>
    </div>

    <div class="col-md-4">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php echo $model->partCountFb ?></h3>
            <h6><span style="color:#999">Total Feedback</span></h6>
        </div>
    </div>

    <div class="col-md-4">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php echo $model->partResult ?></h3
            <h6><span style="color:#999">Final Result</span></h6>
        </div>
    </div>
</div>


<?php
if (is_dir(Yii::app()->basePath . "/../shareimages/hr/learning/" . $model->id))
    $this->renderPartial('/iLearningHolding/_tabPhotoView', ["id" => $model->id]);
?>

<?php if ($model->partCount() >= 35 || $model->status_id != 1 || strtotime($model->schedule_date) < time()) { ?>

    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Full or Closed or Passed Date!</strong> The Registration is full or has been closed by Training
        Administrator
    </div>

<?php } else { ?>

    <div class="page-header">
        <h3>New Participant</h3>
    </div>

    <?php echo $this->renderPartial('/iLearning/_formParticipant', ['model' => $modelParticipant, 'id' => $model->id]); ?>

<?php } ?>

<?php
$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 'i-learning-sch-part-grid',
    'dataProvider' => iLearningSchPart::model()->search($model->id),
    //'filter'=>$model,
    'columns' => [
        //'employee.employee_name',
        [
            //'header'=>'employee_id',
            'type' => 'raw',
            'value' => '$data->employee->PhotoPath',
            'htmlOptions' => [
                'class' => 'col-md-1',
            ],
        ],
        [
            'name' => 'employee_id',
            'type' => 'raw',
            //'value' => '$data->employee->employee_name ." - ".$data->employee->mCompany()',
            'value' => function ($data) {
                    return $data->employee->employee_name
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->employee->mDepartment());
                },
        ],
        [
            'name' => 'flow_id',
            'value' => '$data->flow->name',
        ],
        [
            'header' => 'Result',
            'value' => '$data->resultFeedback'
        ],
        //'day1',
        //'day2',
        //'day3',
        //'day4',
        //array(
        //	'class'=>'TbButtonColumn',
        //	'template'=>'{update}{delete}',
        //),
    ],
]);
?>

