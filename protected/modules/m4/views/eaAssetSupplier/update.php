<?php
$this->breadcrumbs = [
    'Ea Asset Suppliers' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];
$this->menu = [
    ['label' => 'List eaAssetSupplier', 'url' => ['index']],
    ['label' => 'Create eaAssetSupplier', 'url' => ['create']],
    ['label' => 'View eaAssetSupplier', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage eaAssetSupplier', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>
            Update eaAssetSupplier
            <?php echo $model->id; ?>
        </h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>