<?php
$this->widget('TbGridView', [
    'id' => 'g-person-costcenter-grid',
    'dataProvider' => gPersonCostcenter::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'start_date',
        'end_date',
        [
            'header' => 'Company',
            'value' => 'isset($data->company->name) ? $data->company->name : ""',
        ],
        'remark',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPersonCostcenter/deleteCostcenter",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPersonCostcenter/updateCostcenter',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Cost Center',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            //'visible' => ($this->id == "gPerson")
        ],
    ],
]);
?>

    <div class="page-header">
        <h3>New Cost Center</h3>
    </div>
<?php
echo $this->renderPartial('_formCostcenter', ['model' => $modelCostcenter]);

