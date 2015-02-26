<?php
$this->breadcrumbs = [
    'Ea Asset Categories' => ['index'],
    $model->id,
];
$this->menu = [
    ['label' => 'List eaAssetCategory', 'url' => ['index']],
    ['label' => 'Create eaAssetCategory', 'url' => ['create']],
    ['label' => 'Update eaAssetCategory', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete eaAssetCategory', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Manage eaAssetCategory', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>
        View eaAssetCategory #
        <?php echo $model->id; ?>
    </h1>
</div>
<?php
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'parent_id',
        'inventory_type',
        'type1_info',
        'type2_info',
        'remarks',
    ],
]);
?>
