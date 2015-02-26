<?php
$this->breadcrumbs = [
    'Ea Asset Owners' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];
$this->menu = [
    ['label' => 'List eaAssetOwner', 'url' => ['index']],
    ['label' => 'Create eaAssetOwner', 'url' => ['create']],
    ['label' => 'View eaAssetOwner', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage eaAssetOwner', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>
            Update eaAssetOwner
            <?php echo $model->id; ?>
        </h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>