<?php
$this->breadcrumbs = [
    'Ea Asset Categories' => ['index'],
    'Create',
];
$this->menu = [
    ['label' => 'List eaAssetCategory', 'url' => ['index']],
    ['label' => 'Manage eaAssetCategory', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>Create eaAssetCategory</h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>