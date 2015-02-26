<br/>

<?php
Yii::app()->clientScript->registerScript('sel_status', "
        $('#selStatus').change(function() {
            //alert(this.value);
            $.fn.yiiGridView.update('g-expense-grid', {
                    data: $(this).serialize()
            });            
            return false;
        });
    ");


$data = CHtml::listData(['2' => 'Travel', '3' => 'Return to Homebase'], 'expense_id', 'Expense');

$select = key($data);

echo CHtml::dropDownList(
    'dropDownStatus',
    $select,
    ['2' => 'Travel', '3' => 'Return to Homebase'],
    [
        'style' => 'margin-bottom:10px;',
        'id' => 'selStatus',
        'class' => 'form-control',
    ]
);
?>

<?php

$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('process_date'),
    'id' => 'g-expense-grid',
    'dataProvider' => gExpense::model()->search($model->id, $select),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'header' => 'Start - End Date',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->start_date . " - <br/>" 
                    . $data->end_date . "<br/>" 
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->number_of_day ." day(s)");
                },
            'htmlOptions' => [
                'style' => 'min-width:150px;',
            ],
        ],
        [
            'header' => 'Type - Purpose',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->expense_type->name
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->purpose);
                },
        ],
        [
            'header' => 'Destination (Advanced / Realization Amount)',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->destination
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], peterFunc::indoFormat($data->original_amount))
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], peterFunc::indoFormat($data->detailC));
                },
        ],
        [
            'header' => 'Superior/ HR Status',
            'type' => 'raw',
            //'value' => '$data->superior_approved->name',
            'value' => function ($data) {
                    return $data->superior_approved->name . " " . CHtml::tag('i', ['style' => 'color: #999; font-size: 12px'], $data->created->username) . "<br/>" .
                    $data->approved->name . " " . CHtml::tag('i', ['style' => 'color: #999; font-size: 12px'], ($data->created_by != $data->updated_by && isset($data->updated->username)) ? $data->updated->username : "");
                },
        ],
        //[
        //    'name'=>'balance',
            //'visible'=>'$data->expense_id == 3'
        //],
        [
            'class' => 'TbButtonColumn',
            'template' => '{approved}{verified}{print}',
            'buttons' => [
                'approved' => [
                    'label' => 'Approved',
                    'url' => 'Yii::app()->createUrl("/m1/gExpense/approved",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
														$.fn.yiiGridView.update("g-expense-grid", {
														data: $(this).serialize()
                                            });
                                        }',
                        ],
                        'class' => 'btn btn-xs btn-default',
                    ],
                ],
                'verified' => [
                    'label' => 'Verified Realization',
                    'url' => 'Yii::app()->createUrl("/m1/gExpense/viewVerified",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->approved_id ==2',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                    ],
                ],
                'print' => [
                    'label' => ' Print',
                    'url' => 'Yii::app()->createUrl("/m1/gExpense/printExpense",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                    ],
                ],
            ],
        ],
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gExpense/delete",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gExpense/update',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
    ],
]);
