<?php
$this->widget('TbGridView', [
    'id' => 'g-payroll-grid',
    'dataProvider' => gPayrollTemplate::model()->search($model->id),
    'template' => '{items}',
    'htmlOptions' => ["style" => "padding-top:0px"],
    'columns' => [
        'yearmonth_start',
        [
            'name' => 'category.name',
            'header' => 'Catagory',
        ],
        [
            'header' => 'Current Salary',
            'type' => 'raw',
            'value' => 'peterFunc::indoFormat($data->basic_salary)',
            'htmlOptions' => [
                'style' => 'text-align: right;margin-right;2px'
            ]
        ],
        [
            'header' => 'Prorate',
            'type' => 'raw',
            'value' => 'peterFunc::indoFormat($data->prorate_salary)',
            'htmlOptions' => [
                'style' => 'text-align: right;margin-right;2px'
            ]
        ],
        'remark',
        [
            //'visible'=>false,
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'template'=>'{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPayroll/delete",array("id"=>$data["id"]))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPayroll/update',
                'actionParams' => ['id' => '$data["id"]'],
                'dialogTitle' => 'Update',
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


    <h4>New Payroll</h4>

<?php
echo $this->renderPartial('_formPayroll', ['model' => $modelPayroll]);
