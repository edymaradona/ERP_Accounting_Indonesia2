<?php

$this->beginWidget('booster.widgets.TbPanel', [
    'title' => false,
    'headerIcon' => 'fa fa-globe fa-fw',
    //'htmlHeaderOptions' => ['style' => 'background:white'],
    //'htmlContentOptions'=>array('style'=>'background:#FFA573'),
]);
?>

<?php

$this->widget('booster.widgets.TbDetailView', [
    'data' => [
        'id' => 1,
        'employee_id' => $model->employeeShortId,
        'company' => $model->mCompany(),
        'department' => $model->mDepartment(),
        'job_title' => $model->mJobTitle(),
        'level' => $model->mLevel(),
        'status' => ($model->countContract() != "") ? $model->mStatus() . " " . CHtml::tag('span', ['class' => 'badge badge-warning'], $model->countContract()) : $model->mStatus(),
        'join_date' => (isset($model->companyfirst)) ? $model->companyfirst->start_date . " " . CHtml::tag('span', ['class' => 'badge badge-info'], $model->countJoinDate()) : "",
        'join_dateG' => (isset($model->companyfirstG)) ? $model->companyfirstG->start_date . " " . CHtml::tag('span', ['class' => 'badge badge-info'], $model->countJoinDateG()) : "",
        'join_dateB' => ($model->mJoinTypeId() == 2) ? $model->companycurrent->start_date . " " . CHtml::tag('span', ['class' => 'badge badge-info'], $model->countJoinDateB()) : "",
        'superior' => ($this->id == "gEss") ? $model->mSuperior() : $model->mSuperiorLink(),
    ],
    'attributes' => [
        ['name' => 'employee_id', 'label' => 'Employee ID'],
        ['name' => 'company', 'label' => 'Company'],
        ['name' => 'department', 'label' => 'Department'],
        ['name' => 'job_title', 'label' => 'Job Title'],
        ['name' => 'level', 'label' => 'Level'],
        ['name' => 'status', 'type' => 'raw', 'label' => 'Status'],
        ['name' => 'join_date', 'type' => 'raw', 'label' => 'Join Date'],
        ['name' => 'join_dateB', 'type' => 'raw', 'label' => 'Join Date Biz Unit', 'visible' => ($model->mJoinTypeId() == 2)],
        ['name' => 'join_dateG', 'type' => 'raw', 'label' => 'Join Date APG', 'visible' => (isset($model->companyfirstG))],
        ['name' => 'superior', 'type' => 'raw', 'label' => 'Superior'],
    ],
]);
?>

<?php

$this->endWidget();
?>


