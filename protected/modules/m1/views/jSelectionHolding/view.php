<?php
/* @var $this JSelectionController */
/* @var $model jSelection */

$this->breadcrumbs = [
    'J Selections' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/jSelectionHolding']],
    ['label' => 'Update', 'icon' => 'pencil', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

<div class="page-header">
    <h1>
        <i class="fa fa-tasks fa-fw"></i>
        <?php echo $model->category->name; ?></h1>
</div>

<?php
$this->widget('TbDetailView', [
    'data' => $model,
    'attributes' => [
        //'pic',
        [
            'label' => 'Category',
            'name' => 'category.name',
        ],
        'schedule_date',
        'additional_info',
        //'cost',
        [
            'label' => 'Status',
            'name' => 'status.name',
        ],
    ],
]);
?>

<?php
if ($model->category_id == 1) {
    echo $this->renderPartial('_formParticipant', ['model' => $modelParticipant]);

    $this->widget('booster.widgets.TbTabs', [
        'type' => 'tabs', // 'tabs' or 'pills'
        'id' => 'tabs',
        'tabs' => [
            ['id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabViewDetail", ["model" => $model], true), 'active' => true],
        ],
    ]);
} else {
    echo $this->renderPartial('_formEmployee', ['model' => $modelParticipant]);

    $this->widget('booster.widgets.TbTabs', [
        'type' => 'tabs', // 'tabs' or 'pills'
        'id' => 'tabs',
        'tabs' => [
            ['id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabViewDetailEmp", ["model" => $model], true), 'active' => true],
            ['id' => 'tab2', 'label' => 'Assessment', 'content' => $this->renderPartial("_tabViewAssessmentEmp", ["model" => $model], true)],
        ],
    ]);
}
?>


