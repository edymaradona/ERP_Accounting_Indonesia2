<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            Create Travel / Return to Homebase
        </h1>
    </div>


<?php
echo $this->renderPartial('_formExpense', ['model' => $model]);
