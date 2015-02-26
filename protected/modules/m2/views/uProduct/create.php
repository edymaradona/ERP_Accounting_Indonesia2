<?php
$this->breadcrumbs = [
    'X Products' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'List xProduct', 'url' => ['index']],
    ['label' => 'Manage xProduct', 'url' => ['admin']],
];
?>

    <h1>Create xProduct</h1>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>