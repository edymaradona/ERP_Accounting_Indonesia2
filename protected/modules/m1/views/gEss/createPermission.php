<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-hand-o-up fa-fw"></i>
            Create Permission
        </h1>
    </div>


<?php
echo $this->renderPartial('_formPermission', ['model' => $model]);
