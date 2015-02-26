<?php
$this->breadcrumbs = [
    'C Suppliers' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'List uSupplier', 'url' => ['index']],
    ['label' => 'Create uSupplier', 'url' => ['create']],
    ['label' => 'View uSupplier', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage uSupplier', 'url' => ['admin']],
];
?>

    <div class="page-header">
        <h1>
            Update uSupplier
            <?php echo $model->id; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>