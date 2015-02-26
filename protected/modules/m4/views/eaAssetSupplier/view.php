<?php
$this->breadcrumbs = [
    'Ea Asset Suppliers' => ['index'],
    $model->id,
];
$this->menu = [
    ['label' => 'List eaAssetSupplier', 'url' => ['index']],
    ['label' => 'Create eaAssetSupplier', 'url' => ['create']],
    ['label' => 'Update eaAssetSupplier', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete eaAssetSupplier', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Manage eaAssetSupplier', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>
        View eaAssetSupplier #
        <?php echo $model->id; ?>
    </h1>
</div>
<?php
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'supplier_name',
        'telpon',
        'fax',
        'remarks',
    ],
]);
?>
