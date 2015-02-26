<?php
$this->breadcrumbs = [
    'U Ars' => ['index'],
    'Manage',
];


$this->menu = [
    ['label' => 'AP Supplier', 'icon' => 'home', 'url' => ['/m2/uAp/apSupplier']],
];
?>


<div class="page-header">
    <h1>Account Payable: Paid / Posting</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'Unpaid. New Purchased Order', 'url' => Yii::app()->createUrl('/m2/uAp')],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uAp/onHalfPaid')],
        ['label' => 'Paid. Post to GL', 'url' => Yii::app()->createUrl('/m2/uAp/onPaid'), 'active' => true],
        ['label' => 'Recent AP', 'url' => Yii::app()->createUrl('/m2/uAp/onRecent')],
    ],
]);
?>



<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-ar-grid',
    'dataProvider' => uAp::model()->onPaid(),
    //'filter'=>$model,
    'columns' => [
        //'entity_id',
        //'periode_date',
        //'ar_type_id',
        [
            'name' => 'po.system_ref',
            'type' => 'raw',
            'value' => 'CHtml::link($data->po->system_ref,Yii::app()->createUrl("/m2/uAp/view",array("id"=>$data->id)))'
        ],
        'po.input_date',
        //'entity.name',
        [
            'header' => 'Supplier',
            'type' => 'raw',
            'value' => 'CHtml::link($data->po->supplier->company_name,Yii::app()->createUrl("/m2/uAp/apSupplier",array("id"=>$data->po->supplier_id)))',
        ],
        //'po.po_type_id',
        //'po.remark',
        'remark',
        [
            'name' => 'total_amount',
            'value' => 'peterFunc::indoFormat($data->total_amount)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Total Paid',
            'value' => 'peterFunc::indoFormat($data->paymentSum)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'type' => 'raw',
            'value' => '($data->journal_state_id == 1) ?
					CHtml::link("Post to GL",Yii::app()->createUrl("/m2/uAp/createJournal",array("id"=>$data->id)),array("class"=>"btn btn-mini btn-primary")) : 
		            CHtml::tag("span", array("class" => "label label-info"), "Posted");
			',
        ]
    ],
]);
?>

