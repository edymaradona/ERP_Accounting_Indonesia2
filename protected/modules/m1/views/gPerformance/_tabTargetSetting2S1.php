<br/>
<h4>Semester I</h4>


<?php
//$this->widget('booster.widgets.TbGridView',array(
$this->widget('booster.widgets.TbGroupGridView', [
    'id' => 'g-target-setting-grid21',
    //'dataProvider'=>$model->search(),
    'dataProvider' => gTalentTargetSetting::model()->search($model->id, $year, 1),
    'type' => 'condensed',
    //'filter'=>$model,
    'template' => '{items}',
    'extraRowColumns' => ['strategic.name'],
    //'extraRowExpression' =>  '"<b style=\"padding:20px 0;\">".$data->strategic_objective."</b>"',
    'columns' => [
        //'company_id',
        'year',
        [
            'header' => 'Perspective',
            'name' => 'strategic.name',
        ],
        'strategic_desc',
        'kpi_desc',
        //'strategic_initiative',
        'weight',
        'target',
        'unit',
        //'remark',
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'realization',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateTargetAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'value_type_id',
            // 'headerHtmlOptions' => array('style' => 'width: 60px'),
            'editable' => [
                'type' => 'select',
                'url' => $this->createUrl('/m1/gPerformance/updateTargetAjax'),
                'source' => ['1' => 'Min', '2' => 'Max', '3' => 'report'],
            ]
        ],
        [
            'header' => 'Realisation vs Target',
            'value' => '$data->realizationVsTarget',
        ],
        [
            'header' => 'Individual Score',
            'value' => '$data->individualScore',
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'superior_score',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateTargetAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'header' => 'Superior Score vs Weight',
            'value' => '$data->superiorVsWeight',
        ],
        [
            'header' => 'Created Date/By',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->created->username
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], date('d-m-Y', ($data->created_date)));
                }
        ],
        [
            'header' => 'Updated Date/By',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->updated->username
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], date('d-m-Y', ($data->updated_date)));
                }
        ],
    ],
]);
?>

