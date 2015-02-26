<?php
$this->breadcrumbs = [
    'C Customers' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/uCustomer']],
    ['label' => 'Update', 'icon' => 'pencil', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
];

$this->menu5 = ['Customer'];
?>

<div class="page-header">
    <h1>
        <?php echo $model->company_name; ?>
    </h1>
</div>


<?php $this->renderPartial('_detail', ['model' => $model]); ?>
