<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-planet fa-fw"></i>
            <?php echo "Change Attendance: " . $model->employee_name; ?>
        </h1>
    </div>


<?php
echo $this->renderPartial('_formAttendance', ['model' => $modelAttendance]);
