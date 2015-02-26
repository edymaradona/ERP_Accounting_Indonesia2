<?php
$this->breadcrumbs = [
    'Ea Asset Suppliers',
];
$this->menu = [
    ['label' => 'Create eaAssetSupplier', 'url' => ['create']],
    ['label' => 'Manage eaAssetSupplier', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>Ea Asset Suppliers</h1>
</div>
<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
?>
