<?php
$this->breadcrumbs = [
    'Ea Asset Locations' => ['index'],
    'Create',
];
$this->menu = [
    ['label' => 'List eaAssetLocation', 'url' => ['index']],
    ['label' => 'Manage eaAssetLocation', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>Create eaAssetLocation</h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>