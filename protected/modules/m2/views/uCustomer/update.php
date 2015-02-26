<?php
$this->breadcrumbs = [
    'C Customers' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/uCustomer']],
    ['label' => 'View', 'icon' => 'pencil', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
];
?>

    <div class="page-header">
        <h1>
            Update:
            <?php echo $model->company_name; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>