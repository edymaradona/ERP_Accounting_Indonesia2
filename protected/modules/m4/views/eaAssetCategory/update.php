<?php
$this->breadcrumbs = [
    'Ea Asset Categories' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];
$this->menu = [
    ['label' => 'List eaAssetCategory', 'url' => ['index']],
    ['label' => 'Create eaAssetCategory', 'url' => ['create']],
    ['label' => 'View eaAssetCategory', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage eaAssetCategory', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>
            Update eaAssetCategory
            <?php echo $model->id; ?>
        </h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>