<?php
$this->breadcrumbs = [
    'Cash and Bank' => ['index'],
    $model->system_ref,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/uCashbank']],
    ['label' => 'Update', 'icon' => 'edit', 'url' => ['update', 'id' => $model->id], 'visible' => in_array($model->state_id, [1, 2])],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?'], 'visible' => in_array($model->state_id, [1, 2])],
    ['label' => 'Print', 'icon' => 'print', 'url' => ['print', 'id' => $model->id]],
];

$this->menu1 = tJournal::getTopUpdated(2);
$this->menu2 = tJournal::getTopCreated(2);
//$this->menu3=tJournal::getTopRelated($model->user_ref);
$this->menu5 = ['Journal'];
?>

<div class="page-header">
    <h1>
        <?php echo $model->system_reff; ?>
    </h1>
</div>

<p>
    <?php echo $model->remark; ?>
</p>

<?php
//$this->widget('booster.widgets.TbDetailView', array(
$this->widget('ext.XDetailView', [
    'ItemColumns' => 2,
    'data' => $model,
    'attributes' => [
        'input_date',
        'yearmonth_periode',
        [
            'label' => 'Receiver',
            'name' => 'cb_custom1',
            'visible' => $model->journal_type_id == 2,
        ],
        [
            'label' => 'Received From',
            'name' => 'cb_custom1',
            'visible' => $model->journal_type_id == 1,
        ],
        //'remark',
    ],
]);
?>

<?php echo $this->renderPartial('/tJournal/_viewDetail', ['data' => $model]); ?>


<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-reorder"></i>Related Journal</li>
    </ul>
</div>

<?php
if (empty($_GET['asDialog'])) {
    //$this->widget('booster.widgets.TbGridView', array(
    $this->widget('ext.groupgridview.GroupGridView', [
        'id' => 'related-grid',
        'dataProvider' => $dataProvider,
        'template' => '{items}',
        'itemsCssClass' => 'table table-striped table-bordered',
        'mergeColumns' => ['input_date'],
        'enableSorting' => false,
        'columns' => [
            'input_date',
            //'yearmonth_periode',
            //'user_ref',
            [
                'header' => 'No Ref',
                'type' => 'raw',
                'value' => 'CHtml::link($data->system_ref,Yii::app()->createUrl("/m2/uCashbank/view",array("id"=>$data->id)))',
            ],
            'remark',
            [
                'header' => 'Total',
                'value' => 'peterFunc::indoFormat($data->journalSum)',
                'htmlOptions' => [
                    'style' => 'text-align: right; padding-right: 5px;'
                ],
            ],
        ],
    ]);
}
?>
