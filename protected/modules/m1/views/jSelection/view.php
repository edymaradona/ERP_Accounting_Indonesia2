<?php
$this->breadcrumbs = [
    'Selection' => ['index'],
];

$this->menu7 = hApplicant::model()->topRecentApplicant;

$this->menu = [
    ['label' => 'Vacancy', 'icon' => 'home', 'url' => ['/m1/hVacancy']],
    ['label' => 'Applicant', 'icon' => 'user', 'url' => ['/m1/hApplicant']],
    ['label' => 'Selection Registration', 'icon' => 'tint', 'url' => ['/m1/jSelection']],
    ['label' => 'Interview', 'icon' => 'volume-up', 'url' => ['/m1/hVacancy/interview']],
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



<?php if ($model->partCount() >= 15 || $model->status_id != 1 || strtotime($model->schedule_date) < time()) { ?>
    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Full or Closed or Passed Date!</strong> The Registration is full or has been closed by Selection Holding
        Administrator
    </div>
<?php
} else {
    if ($model->category_id == 1) {
        echo $this->renderPartial('_formParticipant', ['model' => $modelParticipant]);
    } else
        echo $this->renderPartial('_formEmployee', ['model' => $modelParticipant]);
}

if ($model->category_id == 1) {
    $this->widget('booster.widgets.TbTabs', [
        'type' => 'tabs', // 'tabs' or 'pills'
        'id' => 'tabs',
        'tabs' => [
            ['id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabViewDetail", ["model" => $model], true), 'active' => true],
        ],
    ]);
} else {
    $this->widget('booster.widgets.TbTabs', [
        'type' => 'tabs', // 'tabs' or 'pills'
        'id' => 'tabs',
        'tabs' => [
            ['id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabViewDetailEmp", ["model" => $model], true), 'active' => true],
        ],
    ]);
}
?>


