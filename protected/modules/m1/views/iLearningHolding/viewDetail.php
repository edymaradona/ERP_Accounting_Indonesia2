<?php
$this->breadcrumbs = [
    'I Learning Sches' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/iLearningHolding']],
    ['label' => $model->getparent->learning_title, 'icon' => 'briefcase', 'url' => ['/m1/iLearningHolding/view', 'id' => $model->parent_id]],
    ['label' => 'Print Absence', 'icon' => 'print', 'url' => ['/m1/iLearningHolding/printDetail', 'id' => $model->id]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = iLearningSch::getTopUpdated();
$this->menu2 = iLearningSch::getTopCreated();
$this->menu5 = ['Sylabus'];
?>

    <div class="page-header">
        <h1><i class="fa fa-book fa-fw"></i>
            <?php echo $model->getparent->learning_title; ?> | <?php echo $model->schedule_date ?></h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="well" style="text-align: center;padding:0">
                <h3><?php echo $model->getMPartCount() . " / " . $model->partCountConfirm ?></h3>
                <h6><span style="color:#999">Total Participant / Confirm</span></h6>
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
                <h3><?php echo $model->partResult ?></h3>
                <h6><span style="color:#999">Final Result</span></h6>
            </div>
        </div>
    </div>

    <br/>

<?php
//$this->widget('booster.widgets.TbDetailView', array(
//$this->widget('ext.XDetailView', [
//    'ItemColumns' => 2,
$this->widget('booster.widgets.TbEditableDetailView', [
    'url' => $this->createUrl('/m1/iLearningHolding/updateScheduleAjax'),
    'data' => $model,
    'attributes' => [
        'trainer_name',
        'location',
        [
            'name' => 'schedule_date',
            'value' => $model->schedule_date,
            'editable' => [
                'type' => 'date',
                'format' => 'dd-mm-yyyy',
                'viewformat' => 'dd-mm-yyyy'
            ]
        ],
        [
            'label' => 'Status',
            'name' => 'status_id',
            'editable' => [
                'type' => 'select2',
                'source' => sParameter::items("cTrainingStatus")
            ]
        ],
        'additional_info',
        [
            'name' => 'Participant',
            'value' => $model->total_participant,
            'visible' => ($model->getparent->type_id == 3),
        ],
        [
            'label' => 'Status',
            'name' => 'certificate_template_id',
            'editable' => [
                'type' => 'select2',
                'source' => ['0' => 'Non Certificate', '1' => 'Template 1', '2' => 'Template 2', '3' => 'Template 3']
            ]
        ],
    ],
]);
?>

<?php
if (is_dir(Yii::app()->basePath . "/../shareimages/hr/learning/" . $model->id))
    $this->renderPartial('_tabPhotoView', ["id" => $model->id]);
?>

<?php if ($model->status_id == 1) { ?>

    <h3>New Participant</h3>

    <?php echo $this->renderPartial('_formParticipant', ['model' => $modelParticipant]); ?>

<?php } ?>

    <br/>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'id' => 'tabs',
    'tabs' => [
        ['id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabViewDetail", ["model" => $model], true), 'active' => true],
        ['id' => 'tab2', 'label' => 'Feed Back', 'content' => $this->renderPartial("_tabViewFeedback", ["model" => $model], true)],
        ['id' => 'tab3', 'label' => 'Photo', 'content' => $this->renderPartial("_tabPhoto", ["model" => $model], true)],
    ],
]);

