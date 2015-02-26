<?php
$this->breadcrumbs = [
    'Ea Asset Owners' => ['index'],
    'Create',
];
$this->menu = [
    ['label' => 'List eaAssetOwner', 'url' => ['index']],
    ['label' => 'Manage eaAssetOwner', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>Create eaAssetOwner</h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>