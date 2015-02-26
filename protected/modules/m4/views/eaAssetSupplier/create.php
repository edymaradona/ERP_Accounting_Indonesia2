<?php
$this->breadcrumbs = [
    'Ea Asset Suppliers' => ['index'],
    'Create',
];
$this->menu = [
    ['label' => 'List eaAssetSupplier', 'url' => ['index']],
    ['label' => 'Manage eaAssetSupplier', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>Create eaAssetSupplier</h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>