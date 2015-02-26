<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            Create Loan
        </h1>
    </div>


<?php
echo $this->renderPartial('_formLoan', ['model' => $model]);
