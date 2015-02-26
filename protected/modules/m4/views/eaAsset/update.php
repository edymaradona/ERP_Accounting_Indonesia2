<?php
$this->breadcrumbs = [
    'eaAssets' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];
$this->menu = [
    ['label' => 'List eaAsset', 'url' => ['index']],
    ['label' => 'Create eaAsset', 'url' => ['create']],
    ['label' => 'View eaAsset', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage eaAsset', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>
            Update eaAsset
            <?php echo $model->id; ?>
        </h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>