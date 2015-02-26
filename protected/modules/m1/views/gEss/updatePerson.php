<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-user fa-fw"></i>
            <?php echo $model->employee_name; ?>
        </h1>
    </div>


<?php
echo $this->renderPartial('_formPerson', ['model' => $model]);
