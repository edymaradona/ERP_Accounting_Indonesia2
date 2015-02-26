<?php
$this->breadcrumbs = [
    'Journal Voucher' => ['index'],
    $model->system_ref,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/tJournal/']],
    ['label' => 'Update', 'icon' => 'edit', 'url' => ['update', 'id' => $model->id], 'visible' => $model->state_id != 4],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?'], 'visible' => $model->state_id != 4],
    ['label' => 'Print', 'icon' => 'print', 'url' => ['print', 'id' => $model->id]],
];

$this->menu1 = tJournal::getTopUpdated(1);
$this->menu2 = tJournal::getTopCreated(1);
//$this->menu3=tJournal::getTopRelated($model->user_ref);
$this->menu5 = ['Journal'];
?>

<div class="page-header">
    <h1>
        <?php echo $model->system_reff; ?>
    </h1>
</div>

<?php
//$this->widget('booster.widgets.TbDetailView', array(
$this->widget('ext.XDetailView', [
    'ItemColumns' => 2,
    'data' => $model,
    'attributes' => [
        'input_date',
        'yearmonth_periode',
        [
            'label' => 'Module',
            'value' => $model->module->name,
        ],
        'user_ref',
        [
            'label' => 'Total',
            'value' => peterFunc::indoFormat($model->journalSum),
        ],
        'remark',
        //'journal_type_id',
    ],
]);
?>

<?php echo $this->renderPartial('/tJournal/_viewDetail', ['data' => $model]); ?>

