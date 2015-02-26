<?php

$this->widget('booster.widgets.TbGridView', [
    'dataProvider' => gAttendance::model()->absenceList(),
    'template' => "{items}",
    'type' => 'condensed',
    'columns' => [
        [
            'value' => 'CHtml::link($data["employee_name"],Yii::app()->createUrl("/m1/gAttendance/view",array("id"=>$data["id"])))',
            'type' => 'raw',
            'header' => 'Employee Name',
        ],
        ['name' => 'workhour', 'header' => 'Jam Kerja (**TODO**)'],
        ['name' => 'cuti', 'header' => 'Cuti'],
        ['name' => 'alpha', 'header' => 'Alpha'],
        ['name' => 'lateIn', 'header' => 'Terlambat'],
        ['name' => 'lateInCount', 'header' => 'Menit'],
        ['name' => 'earlyOut', 'header' => 'Pulang Cepat'],
        ['name' => 'earlyOutCount', 'header' => 'Menit'],
        ['name' => 'tad', 'header' => 'TAD'],
        ['name' => 'tap', 'header' => 'TAP'],
        ['name' => 'sakit', 'header' => 'Sakit'],
        ['name' => 'special', 'header' => 'Khusus'],
    ],
]);
