<?php
$this->breadcrumbs = [
    'C Customers' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'List uCustomer', 'url' => ['index']],
    ['label' => 'Manage uCustomer', 'url' => ['admin']],
];
?>

    <div class="page-header">
        <h1>
            Create Customer
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>