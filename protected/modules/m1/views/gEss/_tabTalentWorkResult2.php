<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-work-result-grid4',
    //'dataProvider'=>$model->search(),
    'dataProvider' => gTalentWorkResult::model()->search($model->id, $year),
    'type' => 'condensed',
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'year',
        //array(
        //	'header'=>'Period',
        //	'value' => '$data->getConvertTalentPeriod($data->period)',
        //),
        //'company_id',
        'talent_template.aspect',
        [
            'name' => 'personal_score',
        ],
        [
            'name' => 'superior_score',
        ],
        'calcFinalResult',
        'remark',
    ],
]);

