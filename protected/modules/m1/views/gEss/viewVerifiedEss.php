<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
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
        [
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name' => 'start_date',
            'sortable' => false,
            'editable' => [
                'type' => 'date',
                'format' => 'dd-mm-yyyy',
                'viewformat' => 'dd-mm-yyyy'
            ]],

        [
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name' => 'end_date',
            'sortable' => false,
            'editable' => [
                'type' => 'date',
                'format' => 'dd-mm-yyyy',
                'viewformat' => 'dd-mm-yyyy'
            ]],
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
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gEss/deleteExpenseDetail",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gEss/updateExpenseDetail',
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

<?php /*
EQuickDlgs::iframeButton(
    [
        'controllerRoute' => 'm1/gExpense/createDetailAjax',
        'actionParams' => ['id' => $model->id],
        'dialogTitle' => 'Create New Travel / Return to Homebase Detail',
        'dialogWidth' => 800,
        'dialogHeight' => 600,
        'openButtonText' => 'Add New Travel / Return to Homebase Detail',
        // 'closeButtonText' => 'Close',
        'closeOnAction' => true, //important to invoke the close action in the actionCreate
        'refreshGridId' => 'g-expense-detail-grid', //the grid with this id will be refreshed after closing
        'openButtonHtmlOptions' => ['class' => 'btn btn-primary'],
    ]
); */

?>

<?php
$this->widget('booster.widgets.TbButton', [
    //'context' => 'primary',
    'buttonType' => 'link',
    'icon' => 'fa fa-check',
    'url' => Yii::app()->createUrl('/m1/gEss/printRealization', ['id' => $modelExpense->id]),
    'label' => 'Print Realization Detail',
]);
?>

<hr/>

<h4>Add New Travel Detail</h4>

<?php
    echo $this->renderPartial('/gExpense/_formExpenseDetail', ['model' => $modelDetail]);
?>
