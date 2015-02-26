<?php
$this->breadcrumbs = [
    'Ea Asset Locations' => ['index'],
    $model->id,
];
$this->menu = [
    ['label' => 'List eaAssetLocation', 'url' => ['index']],
    ['label' => 'Create eaAssetLocation', 'url' => ['create']],
    ['label' => 'Update eaAssetLocation', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete eaAssetLocation', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Manage eaAssetLocation', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>
        View eaAssetLocation #
        <?php echo $model->id; ?>
    </h1>
</div>
<?php
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'parent_id',
        'location',
        'remarks',
    ],
]);
?>
