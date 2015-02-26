<?php

$mEss = gPerson::model()->find('userid = ' . Yii::app()->user->id);

if (isset($mEss->employee_name)) {

    //echo $model->photoPath;
    $myear = ($year == 0) ? date('Y') : $year;

    $this->menu4 = include(Yii::app()->basePath . '/config/personalizeEssSbLink.php');

    $this->menu = include(Yii::app()->basePath . '/config/personalizeEssSbCreate.php');

    /*$this->menu1 = [
        ['label' => 'Print', 'icon' => 'print', 'items'=> [
            ['label' => 'Print Leave History', 'icon' => 'print', 'url' => ['/m1/gEss/summaryLeave', "pid" => $mEss->id]],
            ['label' => 'Print Monthly Attendance | ' . date("Ym", strtotime(date("Y-m", strtotime($month . " month")) . "-01")),
                'icon' => 'print', 'url' => ['/m1/gEss/summaryAttendance', 'id' => $mEss->id, 'month' => $month]],
            ['label' => 'Print Medical History', 'icon' => 'print', 'url' => ['/m1/gEss/summaryMedical', "pid" => $mEss->id]],
        ]],
    ];*/

    $this->menu7 = gPerson::subOrdinate();
} else {
    $this->menu4 = [
        ['label' => 'Home ESS', 'icon' => 'home', 'url' => ['/m1/gEss']],
    ];
}
