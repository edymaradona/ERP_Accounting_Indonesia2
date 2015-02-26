<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>


    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            <?php echo $model->employee_name; ?>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <?php
            echo $this->renderPartial("/gExpense/_ExpenseBalance", ["model" => $model], true);
            ?>
        </div>
    </div>


<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => [
        ['label' => 'Travel', 'content' => $this->renderPartial("_expenseTravel", ["model" => $model], true), 'active' => true],
        ['label' => 'Return to Homebase', 'content' => $this->renderPartial("_expenseReturn", ["model" => $model], true)],
    ],
]);


