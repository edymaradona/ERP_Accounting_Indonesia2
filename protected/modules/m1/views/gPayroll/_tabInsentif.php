<?php
$this->widget('TbGridView', [
    'id' => 'g-payroll-insentif-grid',
    'dataProvider' => gPayrollTemplateInsentif::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => ["style" => "padding-top:0px"],
    'columns' => [
        [
            'name' => 'insentif_name',
        ],
        'yearmonth_start',
        [
            'header' => 'Current Amount',
            'value' => 'peterFunc::indoFormat($data->amount)',
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
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPayroll/deleteInsentif",array("id"=>$data["id"]))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPayroll/updateInsentif',
                'actionParams' => ['id' => '$data["id"]'],
                'dialogTitle' => 'Update Insentif',
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

    <h4>New Insentif</h4>

<?php
echo $this->renderPartial('_formInsentif', ['model' => $modelPayrollInsentif]);
