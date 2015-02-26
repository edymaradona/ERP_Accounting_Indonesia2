<?php
$this->breadcrumbs = [
    'C Suppliers' => ['index'],
    $model->id,
];

$this->menu = [
    //array('label'=>'Create','url'=>array('create')),
    ['label' => 'Update', 'icon' => 'pencil', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
];

$this->menu5 = ['Supplier'];
?>

<div class="page-header">
    <h1>
        <?php echo $model->company_name; ?>
    </h1>
</div>

<?php
$this->widget('booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        'pic',
        'address',
        'city',
        'pos_code',
        'province',
        'telephone',
        'fax',
        'email',
        'status_id',
    ],
]);
?>
