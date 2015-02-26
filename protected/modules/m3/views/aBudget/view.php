<?php
$this->breadcrumbs = [
    'Budget' => ['index'],
    $model->name,
];

$this->menu = [
    ['label' => 'List aBudget', 'url' => ['index']],
    ['label' => 'Create aBudget', 'url' => ['create']],
    ['label' => 'Update aBudget', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete aBudget', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Manage aBudget', 'url' => ['admin']],
];
?>
<div class="page-header">
    <h1>
        <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/balance.png') ?>
        View aBudget #
        <?php echo $model->id; ?>
    </h1>
</div>
<?php
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'parent_id',
        'year',
        'code',
        'name',
        'unit',
        'amount',
        'remark',
    ],
]);
?>
