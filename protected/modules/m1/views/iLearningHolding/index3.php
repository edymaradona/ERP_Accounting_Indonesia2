<?php
/* @var $this ILearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'I Learnings',
];

$this->menu = [
    ['label' => 'Learning Calendar', 'icon' => 'briefcase', 'url' => ['/m1/iLearningHolding']],
    ['label' => 'List By Subject', 'icon' => 'briefcase', 'url' => ['/m1/iLearningHolding/index2']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu5 = ['Sylabus'];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-book fa-fw"></i>
            Learning List by Date
        </h1>
    </div>


<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'id' => 'tabs',
    'tabs' => [
        ['id' => 'tab1', 'label' => 'Upcoming Event', 'content' => $this->renderPartial("_tabEventComing", [], true), 'active' => true],
        ['id' => 'tab2', 'label' => 'Past Event', 'items' => [
            ['id' => 'tab2a', 'label' => 'Past Event Success', 'content' => $this->renderPartial("_tabEventPastSuccess", [], true)],
            ['id' => 'tab2B', 'label' => 'Past Event Cancelled', 'content' => $this->renderPartial("_tabEventPastCancel", [], true)],
        ]],
    ],
]);

