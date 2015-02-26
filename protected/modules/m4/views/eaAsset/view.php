<?php
$this->breadcrumbs = [
    'eaAssets' => ['index'],
    $model->id,
];
$this->menu = [
    ['label' => 'List eaAsset', 'url' => ['index']],
    ['label' => 'Create eaAsset', 'url' => ['create']],
    ['label' => 'Update eaAsset', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete eaAsset', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Manage eaAsset', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>
        View eaAsset #
        <?php echo $model->id; ?>
    </h1>
</div>
<?php
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'input_date',
        'periode_date',
        'item',
        'brand',
        'type',
        'serial_number',
        'category_id',
        'inventory_code',
        'bpb_number',
        'po_number',
        //'amount',
        'supplier_id',
        'warranty',
        'insurance',
        'remark',
        'photo_path',
        'accesslevel_id',
        'created_date',
        'created_by',
        'updated_date',
        'updated_by',
    ],
]);
?>
