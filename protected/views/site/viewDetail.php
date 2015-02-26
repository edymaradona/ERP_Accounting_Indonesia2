<?php
$this->breadcrumbs = [
    'Learning Schedule' => ['index'],
    //$model->id,
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/m1/iLearning']],
    ['label' => $model->getparent->learning_title, 'url' => ['/m1/iLearning/view', 'id' => $model->parent_id]],
];
?>

<h1>
    <i class="fa fa-book fa-fw"></i>
    <?php echo $model->getparent->learning_title; ?></h1>
<h3><?php echo $model->schedule_date ?></h3>

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

