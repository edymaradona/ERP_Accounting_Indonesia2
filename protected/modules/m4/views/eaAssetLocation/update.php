<?php
$this->breadcrumbs = [
    'Ea Asset Locations' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];
$this->menu = [
    ['label' => 'List eaAssetLocation', 'url' => ['index']],
    ['label' => 'Create eaAssetLocation', 'url' => ['create']],
    ['label' => 'View eaAssetLocation', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage eaAssetLocation', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>
            Update eaAssetLocation
            <?php echo $model->id; ?>
        </h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>