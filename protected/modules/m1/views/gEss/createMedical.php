<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-medkit fa-fw"></i>
            Create Medical
        </h1>
    </div>


<?php
echo $this->renderPartial('_formMedical', ['model' => $model]);
