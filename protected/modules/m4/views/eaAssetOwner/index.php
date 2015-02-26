<?php
$this->breadcrumbs = [
    'Ea Asset Owners',
];
$this->menu = [
    ['label' => 'Create eaAssetOwner', 'url' => ['create']],
    ['label' => 'Manage eaAssetOwner', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>Ea Asset Owners</h1>
</div>
<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
?>
