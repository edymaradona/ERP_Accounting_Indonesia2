<?php
/* @var $this ILearningController */
/* @var $model iLearning */

$this->breadcrumbs = [
    'I Learnings' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/m1/iLearning']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
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
        ['id' => 'tab1', 'label' => 'Schedule', 'content' => $this->renderPartial("_tabSchedule", ["model" => $model], true), 'active' => true],
        ['id' => 'tab5', 'label' => 'Detail', 'content' => $this->renderPartial("_tabDetail", ["model" => $model], true)],
    ],
]);
