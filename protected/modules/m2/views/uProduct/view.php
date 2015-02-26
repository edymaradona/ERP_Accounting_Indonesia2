<?php
$this->breadcrumbs = [
    'X Products' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'List xProduct', 'url' => ['index']],
    ['label' => 'Create xProduct', 'url' => ['create']],
    ['label' => 'Update xProduct', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete xProduct', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Manage xProduct', 'url' => ['admin']],
];
?>

<h1>
    View xProduct #
    <?php echo $model->id; ?>
</h1>

<?php
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'parent_id',
        'item_name',
        'photo_path',
        'created_date',
        'created_id',
        'updated_date',
        'updated_id',
    ],
]);
?>
