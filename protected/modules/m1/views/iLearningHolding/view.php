<?php
/* @var $this ILearningController */
/* @var $model iLearning */

$this->breadcrumbs = [
    'I Learnings' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/iLearningHolding']],
    ['label' => 'Update', 'icon' => 'pencil', 'url' => ['/m1/iLearningHolding/update', 'id' => $model->id]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = iLearning::getTopUpdated();
$this->menu2 = iLearning::getTopCreated();
$this->menu5 = ['Sylabus'];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-book fa-fw"></i>
            <?php echo $model->learning_title; ?>
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'id' => 'tabs',
    'tabs' => [
        ['id' => 'tab1', 'label' => 'Upcoming Event', 'content' => $this->renderPartial("_tabEventComingById", ["model" => $model, 'type' => $model->type_id], true), 'active' => true],
        ['id' => 'tab2', 'label' => 'Past Event', 'content' => $this->renderPartial("_tabEventPastById", ["model" => $model], true)],
        ['id' => 'tab5', 'label' => 'Detail', 'content' => $this->renderPartial("/iLearning/_tabDetail", ["model" => $model], true)],
    ],
]);
?>

    <div class="page-header">
        <h3>New Schedule</h3>
    </div>

<?php
echo $this->renderPartial('_formSchedule', ['type' => $model->type_id, 'model' => $modelSchedule]);

