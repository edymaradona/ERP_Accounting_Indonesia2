<?php
$this->breadcrumbs = [
    'Ea Asset Locations',
];
$this->menu = [
    ['label' => 'Create eaAssetLocation', 'url' => ['create']],
    ['label' => 'Manage eaAssetLocation', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>Ea Asset Locations</h1>
</div>
<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
?>
