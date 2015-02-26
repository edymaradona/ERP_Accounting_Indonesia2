<?php
$this->breadcrumbs = [
    'Ea Asset Owners' => ['index'],
    $model->id,
];
$this->menu = [
    ['label' => 'List eaAssetOwner', 'url' => ['index']],
    ['label' => 'Create eaAssetOwner', 'url' => ['create']],
    ['label' => 'Update eaAssetOwner', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete eaAssetOwner', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Manage eaAssetOwner', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>
        View eaAssetOwner #
        <?php echo $model->id; ?>
    </h1>
</div>
<?php
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'parent_id',
        'owner',
        'remarks',
    ],
]);
?>
