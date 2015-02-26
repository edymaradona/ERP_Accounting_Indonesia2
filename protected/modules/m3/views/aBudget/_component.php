<?php
$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 'abudget-grid',
    'dataProvider' => aBudget::model()->search($id, $pro_id),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    //'filter'=>$model,
    'columns' => [
        'year',
        'code',
        [
            'name' => 'name',
            'type' => 'raw',
            //'value'=>'CHtml::ajaxLink($data->name,Yii::app()->createUrl("/m3/aBudget",array("id"=>$data->id,"pro_id"=>$data->department_id)),
            //array("update" => "#component"))',
            'value' => 'CHtml::link($data->name,Yii::app()->createUrl("/m3/aBudget/filter",array("id"=>$data->id,"pro_id"=>$data->department_id)))',
        ],
        [
            'header' => 'Parent',
            'type' => 'raw',
            //'value'=>'($data->getparent) ? CHtml::ajaxLink($data->getparent->name,Yii::app()->createUrl("/m3/aBudget",array("id"=>$data->getparent->parent_id)),array("update" => "#component")) : ""',
            'value' => '($data->getparent) ? CHtml::link($data->getparent->name,Yii::app()->createUrl("/m3/aBudget/filter",array("id"=>$data->getparent->parent_id))) : ""',
        ],
        //'unit',
        [
            'name' => 'amount',
            //'value'=>'($data->childs) ? $data->sum_aff() : $data->amount',
            'value' => '$data->amountf()',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Total AF (Approved)',
            'value' => '$data->total_af',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Total AF (All)',
            'value' => '$data->total_af_all',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Realization',
            'value' => '($data->parent_id ==0) ? aBudget::model()->allComponent($data->id,2012) : aBudget::model()->allSubComponent($data->id,2012)',
            //'type'=>'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Total Paid',
            'value' => '($data->parent_id ==0) ? aBudget::model()->allComponentPaid($data->id,2012) : aBudget::model()->allSubComponentPaid($data->id,2012)',
            //'type'=>'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Saldo',
            'value' => '(isset($data->end_balance)) ? $data->end_balance->balancef() : ""',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'Percentage',
            'value' => '(isset($data->end_balance)) ? peterFunc::indoFormat($data->end_balance->balance / $data->amount * 100,2) : ""',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'class' => 'ext.TbProgressColumn',
            //'name' => 'percentage',
            //'value'=>'$data->amount',
            'percent' => 100,
            'value' => '(isset($data->end_balance)) ? peterFunc::indoFormat($data->end_balance->balance / $data->amount * 100,2) : ""',
            'htmlOptions' => ['style' => 'width: 100px;'],
        ],
    ],
]);
?>

<hr/>

<?php
$this->widget('booster.widgets.TbDetailView', [
    'data' => [
        'id' => 1,
        'total' => aBudget::model()->getTotalComponent($id),
        'total_r' => aBudget::model()->getTotalComponentR($id),
    ],
    'attributes' => [
        ['name' => 'total', 'label' => 'Total Budget'],
        ['name' => 'total_r', 'label' => 'Total Realization'],
    ],
]);
?>


<hr/>

