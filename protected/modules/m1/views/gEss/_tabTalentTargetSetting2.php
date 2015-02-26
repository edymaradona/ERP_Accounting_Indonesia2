<h3>Full Year + Semester I Only</h3>
<?php

//$this->widget('booster.widgets.TbGridView',array(
$this->widget('booster.widgets.TbGroupGridView', [
    'id' => 'g-target-setting-grid2',
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
            'name' => 'realization',
        ],
        [
            'name' => 'value_type_id',
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
            'header' => 'Status',
            'name' => 'validate.name',
        ],
    ],
]);
?>

<br/>
<h3>Full Year + Semester II Only</h3>
<?php

//$this->widget('booster.widgets.TbGridView',array(
$this->widget('booster.widgets.TbGroupGridView', [
    'id' => 'g-target-setting-grid2',
    //'dataProvider'=>$model->search(),
    'dataProvider' => gTalentTargetSetting::model()->search($model->id, $year, 2),
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
            'name' => 'realization',
        ],
        [
            'name' => 'value_type_id',
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
            'header' => 'Status',
            'name' => 'validate.name',
        ],
    ],
]);
?>
<?php

//if ($year == date('Y'))
//    echo $this->renderPartial('_formTargetSetting', ['model' => $modelTargetSetting, 'year' => $year]);