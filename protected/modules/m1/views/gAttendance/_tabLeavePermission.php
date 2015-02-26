<h3>Leave</h3>
<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-leave-grid',
    'dataProvider' => gLeave::model()->leaveById($model->id, $month),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'start_date',
        'end_date',
        'number_of_day',
        'leave_reason',
    ],
]);
?>

<h4>Permission</h4>
<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-permission-grid',
    'dataProvider' => gPermission::model()->permissionById($model->id, $month),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'start_date',
        'end_date',
        'number_of_day',
        [
            'header' => 'Permission Type',
            'value' => '$data->permission_type->name',
        ],
        [
            'header' => 'Status',
            'value' => '$data->approved->name',
        ],
        'permission_reason'
    ],
]);

