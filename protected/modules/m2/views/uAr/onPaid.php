<?php
$this->breadcrumbs = [
    'U Ars' => ['index'],
    'Manage',
];


$this->menu = [
    ['label' => 'AR Customer', 'icon' => 'home', 'url' => ['/m2/uAr/arCustomer']],
];
?>


<div class="page-header">
    <h1>Account Receivable: Paid / Posting</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'Unpaid. New Sales Order', 'url' => Yii::app()->createUrl('/m2/uAr')],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uAr/onHalfPaid')],
        ['label' => 'Paid. Post to GL', 'url' => Yii::app()->createUrl('/m2/uAr/onPaid'), 'active' => true],
        ['label' => 'Recent AR', 'url' => Yii::app()->createUrl('/m2/uAr/onRecent')],
    ],
]);
?>



<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-ar-grid',
    'dataProvider' => uAr::model()->onPaid(),
    //'filter'=>$model,
    'columns' => [
        //'entity_id',
        //'periode_date',
        //'ar_type_id',
        [
            'name' => 'so.system_ref',
            'type' => 'raw',
            'value' => 'CHtml::link($data->so->system_ref,Yii::app()->createUrl("/m2/uAr/view",array("id"=>$data->id)))'
        ],
        'so.input_date',
        //'entity.name',
        [
            'header' => 'Customer',
            'type' => 'raw',
            'value' => 'CHtml::link($data->so->customer->company_name,Yii::app()->createUrl("/m2/uAr/arCustomerView",array("id"=>$data->so->customer_id)))',
        ],
        //'so.so_type_id',
        //'so.remark',
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
					CHtml::link("Post to GL",Yii::app()->createUrl("/m2/uAr/createJournal",array("id"=>$data->id)),array("class"=>"btn btn-mini btn-primary")) : 
		            CHtml::tag("span", array("class" => "label label-info"), "Posted");
			',
        ]
    ],
]);
?>

