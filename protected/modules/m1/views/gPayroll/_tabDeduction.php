<?php
$this->widget('TbGridView', [
    'id' => 'g-payroll-deduction-grid',
    'dataProvider' => gPayrollTemplateDeduction::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => ["style" => "padding-top:0px"],
    'columns' => [
        [
            'header' => 'Deduction',
            'name' => 'deduction.name',
        ],
        'yearmonth_start',
        'yearmonth_end',
        'type.name',
        [
            'header' => 'Current Amount',
            'value' => 'peterFunc::indoFormat($data->amount_inherit())',
            'htmlOptions' => [
                'style' => 'text-align: right;margin-right:2px;'
            ]
        ],
        [
            'header' => 'Prorate Amount',
            'value' => 'peterFunc::indoFormat($data->prorate)',
            'htmlOptions' => [
                'style' => 'text-align: right;margin-right:2px;'
            ]
        ],
        'remark',
        [
            //'visible'=>false,
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'template'=>'{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPayroll/deleteDeduction",array("id"=>$data["id"]))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPayroll/updateDeduction',
                'actionParams' => ['id' => '$data["id"]'],
                'dialogTitle' => 'Update Deduction',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
        [
            'header' => 'Status',
            'type' => 'raw',
            'value' => '($data["confirm_id"] == 3) ? CHtml::tag("span",array("class"=>"label label-info"),"Full Confirmed") : 
                (($data["confirm_id"] == 2) ? CHtml::tag("span",array("class"=>"label label-success"),"Confirmed") : 
                CHtml::tag("span",array("class"=>"label label-warning"),"Unprocess"))',
        ],
    ],
]);
?>

    <h4>New Deduction</h4>

<?php
echo $this->renderPartial('_formDeduction', ['model' => $modelPayrollDeduction]);

