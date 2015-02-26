<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <h4>Attendance Performance</h4>
</div>


<?php
if ($model->getCountAttendance(peterFunc::cBeginDateBefore(date('Y') . date('m'))) == 1) {

    $this->widget('booster.widgets.TbGridView', [
        'dataProvider' => $model->attendanceStat(),
        'template' => "{items}",
        'type' => 'condensed',
        'columns' => [
            ['name' => 'period', 'header' => 'Period'],
            ['name' => 'workhour', 'header' => 'Work Hour'],
            ['name' => 'cuti', 'header' => 'Leave'],
            //['name' => 'alpha', 'header' => 'Alpha', 'value' => '($data["alpha"] > 0) ? $data["alpha"] : ""'],
            //['name' => 'alpha', 'header' => 'Alpha', 'value' => '"ON PROGRESS"'],
            ['name' => 'lateIn', 'header' => 'Late In'],
            ['name' => 'lateInCount', 'header' => 'Minute'],
            ['name' => 'earlyOut', 'header' => 'Early Out'],
            ['name' => 'earlyOutCount', 'header' => 'Minute'],
            ['name' => 'tad', 'header' => 'Empty In'],
            ['name' => 'tap', 'header' => 'Empty Out'],
            ['name' => 'sakit', 'header' => 'Sick'],
            ['name' => 'special', 'header' => 'Special / Other'],
            [
                'class' => 'TbButtonColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => [
                        'label' => 'Link to Attendance',
                        //'icon' => 'icon-ok-circle',
                        'url' => 'Yii::app()->createUrl("/m1/gEss/attendance",array("id"=>$data["id"],"month"=> $data["cmonth"]))',
                        'options' => [
                            'class' => 'btn btn-primary btn-xs',
                            'style' => 'width:100px'
                        ],
                    ],
                ],
            ],
        ],
    ]);
}
?>
<br/>
