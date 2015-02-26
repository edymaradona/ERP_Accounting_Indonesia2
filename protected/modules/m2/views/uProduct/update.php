<?php
$this->breadcrumbs = [
    'X Products' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'List xProduct', 'url' => ['index']],
    ['label' => 'Create xProduct', 'url' => ['create']],
    ['label' => 'View xProduct', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage xProduct', 'url' => ['admin']],
];
?>

    <h1>
        Update xProduct
        <?php echo $model->id; ?>
    </h1>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>