<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-plane fa-fw"></i>
            Extended Leave
        </h1>
    </div>


<?php
echo $this->renderPartial('_formExtendedLeave', ['model' => $model]);
