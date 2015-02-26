<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    $model->id,
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gExpense']],
    ['label' => 'Link to', 'icon' => 'user', 'items' => [
        ['label' => 'Link to Person', 'icon' => 'user', 'url' => ['/m1/gPerson/view', 'id' => $model->id]],
        ['label' => 'Link to Leave', 'icon' => 'plane', 'url' => ['/m1/gLeave/view', 'id' => $model->id]],
        ['label' => 'Link to Permission', 'icon' => 'hand-o-up', 'url' => ['/m1/gPermission/view', 'id' => $model->id]],
        ['label' => 'Link to Attendance', 'icon' => 'bell', 'url' => ['/m1/gAttendance/view', 'id' => $model->id]],
        ['label' => 'Link to Medical', 'icon' => 'hospital-o', 'url' => ['/m1/gMedical/view', 'id' => $model->id]],
        ['label' => 'Link to Performance', 'icon' => 'fire', 'url' => ['/m1/gPerformance/view', 'id' => $model->id]],
    ]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu = [
    //array('label'=>'Print Summary', 'icon'=>'print', 'url'=>array('/m1/gEss/summaryExpense',"pid"=>$model->id)),
];

//$this->menu1=gExpense::getTopUpdated();
//$this->menu2=gExpense::getTopCreated();
$this->menu5 = ['Travel / Return to Homebase'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gExpense/list')];

?>

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>
                <i class="fa fa-money fa-fw"></i>
                <?php echo $model->employee_name; ?>
            </h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <?php
        echo $this->renderPartial("/gExpense/_ExpenseBalance", ["model" => $model], true);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3>
            <i class="fa fa-plane fa-fw"></i>
            <?php echo $modelExpense->start_date . " - " . $modelExpense->destination; ?>
        </h3>
    </div>
</div>

<?php
$this->widget('TbDetailView', [
    'data' => $modelExpense,
    'attributes' => [
        'start_date',
        'end_date',
    ]
]);
?>
<br/>
<?php
$this->widget('TbEditableDetailView', [
    'data' => $modelExpense,
    'url' => Yii::app()->createUrl('m1/gExpense/UpdateExpenseAjax'),
    'attributes' => [
        'purpose',
        /*[
            'label' => 'Status',
            'name' => 'expense_type_id',
            'editable' => [
                'type' => 'select2',
                'source' => gParamExpense::expenseDropDown()
            ]
        ],*/
        'destination',
        'advanced_amount',
        //'original_amount',
    ],
]);
?>

<br/>

<?php

$this->widget('TbGridView', [
    'id' => 'g-expense-detail-grid',
    'dataProvider' => gExpenseDetail::model()->search($modelExpense->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'header' => 'Category',
            'value' => '$data->expense->getparent->name',
        ],
        [
            'header' => 'Item',
            'value' => '$data->expense->name',
        ],
        'company_name',
        [
            'header' => 'Amount',
            'value' => 'peterFunc::indoFormat($data->amount)',
        ],
        [
            'header' => 'Payment',
            'value' => '$data->payment_source->name',
        ],
        'remark',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gExpense/deleteExpenseDetail",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gExpense/updateExpenseDetail',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Travel / Return to Homebase Detail',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
    ],
]);

?>

<br/>

<?php
$this->widget('booster.widgets.TbButton', [
    //'context' => 'primary',
    'buttonType' => 'link',
    'icon' => 'fa fa-check',
    'url' => Yii::app()->createUrl('/m1/gExpense/printRealization', ['id' => $modelExpense->id]),
    'label' => 'Print Realization Detail',
]);
?>

<h4>Add New Travel Detail</h4>

<?php
    echo $this->renderPartial('_formExpenseDetail', ['id' => $model->id, 'model' => $modelDetail]);
?>

<?php /*
EQuickDlgs::iframeButton(
    [
        'controllerRoute' => 'm1/gExpense/createDetailAjax',
        'actionParams' => ['id' => $modelExpense->id, 'pid' => $model->id],
        'dialogTitle' => 'Create New Travel / Return to Homebase Detail',
        'dialogWidth' => 800,
        'dialogHeight' => 600,
        'openButtonText' => 'Add New Travel / Return to Homebase Detail',
        // 'closeButtonText' => 'Close',
        'closeOnAction' => true, //important to invoke the close action in the actionCreate
        'refreshGridId' => 'g-expense-detail-grid', //the grid with this id will be refreshed after closing
        'openButtonHtmlOptions' => ['class' => 'btn btn-primary'],
    ]
);
*/
?>


