<?php
$this->breadcrumbs = [
    'U Aps' => ['index'],
    'Manage',
];


$this->menu = [
    ['label' => 'AP Supplier', 'icon' => 'home', 'url' => ['/m2/uAp/apSupplier']],
];
?>


<div class="page-header">
    <h1>Account Payable</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'Unpaid. New Purchased Order', 'url' => Yii::app()->createUrl('/m2/uAp'), 'active' => true],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uAp/onHalfPaid')],
        ['label' => 'Paid. Post to GL', 'url' => Yii::app()->createUrl('/m2/uAp/onPaid')],
        ['label' => 'Recent AP', 'url' => Yii::app()->createUrl('/m2/uAp/onRecent')],
    ],
]);
?>



<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-po-grid',
    'dataProvider' => uPo::model()->newPo(),
    //'filter'=>$model,
    'columns' => [
        [
            'name' => 'system_ref',
            'type' => 'raw',
            'value' => 'CHtml::link( (!isset($data->ap)) ? $data->system_ref. " (new)" : $data->system_ref,Yii::app()->createUrl("/m2/uAp/view",array("id"=>$data->id)))'
        ],
        'input_date',
        //'entity.name',
        [
            'header' => 'Supplier',
            'type' => 'raw',
            'value' => 'CHtml::link($data->supplier->company_name,Yii::app()->createUrl("/m2/uAp/apSupplierView",array("id"=>$data->supplier_id)))',
        ],
        'po_type_id',
        'remark',
        [
            'name' => 'poDetail.amount',
            'value' => 'peterFunc::indoFormat($data->poSum)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        /*
          array(
          'header'=>'Check Total',
          'name'=>'total_amount',
          'value' => 'peterFunc::indoFormat($data->ap->total_amount)',
          'htmlOptions' => array(
          'style' => 'text-align: right; padding-right: 5px;'
          ),
          ),
         */
        //array(
        //	'class'=>'booster.widgets.TbButtonColumn',
        //	'template'=>'{delete}',
        //),
    ],
]);
?>

