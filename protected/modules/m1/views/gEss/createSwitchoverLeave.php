<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-plane fa-fw"></i>
            Switch Over Leave
        </h1>
    </div>


<?php
echo $this->renderPartial('_formSwitchoverLeave', ['model' => $model]);
