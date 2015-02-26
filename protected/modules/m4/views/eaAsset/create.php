<?php
$this->breadcrumbs = [
    'eaAssets' => ['index'],
    'Create',
];
$this->menu = [
    ['label' => 'List eaAsset', 'url' => ['index']],
    ['label' => 'Manage eaAsset', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>Create eaAsset</h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>