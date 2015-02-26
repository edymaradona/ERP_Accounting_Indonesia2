<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>


    <div class="page-header">
        <h1>
            <i class="fa fa-leaf fa-fw"></i>
            <?php echo $model->employee_name; ?>
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('start_date'),
    'id' => 'g-permission-grid',
    'dataProvider' => gPermission::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'name' => 'start_date',
            'htmlOptions' => [
                'style' => 'width:100px',
            ],
            'type' => 'raw',
            'value' => function ($data) {
                    return
                        $data->start_date
                        . CHtml::tag('div', ['style' => 'font-size: 11px;'], date('l', strtotime($data->start_date)));
                }
        ],
        [
            'name' => 'end_date',
            'htmlOptions' => [
                'style' => 'width:100px',
            ],
            'type' => 'raw',
            'value' => function ($data) {
                    return
                        $data->end_date
                        . CHtml::tag('div', ['style' => 'font-size: 11px;'], date('l', strtotime($data->end_date)));
                }
        ],
        'number_of_day',
        [
            'header' => 'Permission Type',
            'value' => '$data->permission_type->name',
        ],
        'permission_reason',
        [
            'header' => 'Superior State',
            'value' => '$data->superior_approved->name',
        ],
        [
            'header' => 'HR State',
            'value' => '$data->approved->name',
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{cupdate}',
            'buttons' => [
                'cupdate' => [
                    'label' => 'Update',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/updatePermission",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                    ],
                ],
            ],
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{print}',
            'buttons' => [
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/printPermission",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'target' => '_blank',
                    ],
                ],
            ],
        ],
    ],
]);

