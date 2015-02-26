<?php

//$this->widget('booster.widgets.TbGridView',array(
$this->widget('booster.widgets.TbGroupGridView', [
    'id' => 'g-target-setting-grid1a',
    //'dataProvider'=>$model->search(),
    'dataProvider' => gTalentTargetSetting::model()->search($model->id, $year, 1),
    'type' => 'condensed',
    //'filter'=>$model,
    'template' => '{items}',
    'extraRowColumns' => ['strategic.name'],
    //'extraRowExpression' =>  '"<b style=\"padding:20px 0;\">".$data->strategic_objective."</b>"',
    'columns' => [
        'periodName',
        'year',
        [
            'header' => 'Perspective',
            'name' => 'strategic.name',
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'strategic_desc',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateTargetAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'kpi_desc',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateTargetAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'weight',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateTargetAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'target',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateTargetAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'unit',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateTargetAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        'remark',
        'strategic_initiative',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerformance/deleteTargetSetting",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPerformance/updateTargetSetting',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Target Setting',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{approved}',
            'buttons' => [
                'approved' => [
                    'label' => 'Approved',
                    //'icon' => 'icon-ok-circle',
                    'url' => 'Yii::app()->createUrl("/m1/gPerformance/approved",array("id"=>$data->id,"pid"=>$data->parent_id))',
                    'visible' => '$data->validate_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
								$.fn.yiiGridView.update("g-target-setting-grid1", {
									data: $(this).serialize()
								});
							}',
                        ],
                        'class' => 'btn btn-primary btn-xs',
                    ],
                ],
            ],
        ],
        [
            'header' => 'Status',
            'name' => 'validate.name',
        ],
    ],
]);
?>

<?php

echo $this->renderPartial('_formTargetSetting', ['model' => $modelTargetSetting, 'year' => $year]);
