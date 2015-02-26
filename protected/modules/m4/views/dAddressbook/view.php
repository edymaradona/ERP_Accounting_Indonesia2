<?php
$this->breadcrumbs = [
    'Daddressbooks' => ['index'],
    $model->title,
];
$this->menu = [
    ['label' => 'List DAddressbook', 'url' => ['index']],
    ['label' => 'Create DAddressbook', 'url' => ['create']],
    ['label' => 'Update DAddressbook', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete DAddressbook', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Manage DAddressbook', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>
        View DAddressbook #
        <?php echo $model->id; ?>
    </h1>
</div>
<?php
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'complete_name',
        'company_name',
        'title',
        'address1',
        'address2',
        'address3',
        'handphone',
        'email',
    ],
]);
?>
