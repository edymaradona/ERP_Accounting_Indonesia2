<?php
$this->breadcrumbs = [
    'Ea Asset Categories',
];
$this->menu = [
    ['label' => 'Create eaAssetCategory', 'url' => ['create']],
    ['label' => 'Manage eaAssetCategory', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>Ea Asset Categories</h1>
</div>
<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
?>
