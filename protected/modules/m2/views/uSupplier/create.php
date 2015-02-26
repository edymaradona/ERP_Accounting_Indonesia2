<?php
$this->breadcrumbs = [
    'C Suppliers' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'List uSupplier', 'url' => ['index']],
    ['label' => 'Manage uSupplier', 'url' => ['admin']],
];
?>

    <div class="page-header">
        <h1>
            Create Supplier
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>