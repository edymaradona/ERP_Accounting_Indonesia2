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
    <h1>Account Receivable</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'Unpaid. New Sales Order', 'url' => Yii::app()->createUrl('/m2/uAr'), 'active' => true],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uAr/onHalfPaid')],
        ['label' => 'Paid. Post to GL', 'url' => Yii::app()->createUrl('/m2/uAr/onPaid')],
        ['label' => 'Recent AR', 'url' => Yii::app()->createUrl('/m2/uAr/onRecent')],
    ],
]);
?>



<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'u-so-grid',
    'dataProvider' => uSo::model()->newSo(),
    //'filter'=>$model,
    'columns' => [
        [
            'name' => 'system_ref',
            'type' => 'raw',
            'value' => 'CHtml::link( (!isset($data->ar)) ? $data->system_ref. " (new)" : $data->system_ref,Yii::app()->createUrl("/m2/uAr/view",array("id"=>$data->id)))'
        ],
        'input_date',
        //'entity.name',
        [
            'header' => 'Customer',
            'type' => 'raw',
            'value' => 'CHtml::link($data->customer->company_name,Yii::app()->createUrl("/m2/uAr/arCustomerView",array("id"=>$data->customer_id)))',
        ],
        'so_type_id',
        'remark',
        [
            'name' => 'soDetail.amount',
            'value' => 'peterFunc::indoFormat($data->soSum)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        /*
          array(
          'header'=>'Check Total',
          'name'=>'total_amount',
          'value' => 'peterFunc::indoFormat($data->ar->total_amount)',
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

