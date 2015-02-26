<?php
//$this->widget('booster.widgets.TbGridView',array(
$this->widget('booster.widgets.TbGroupGridView', [
    'id' => 'g-target-setting-grid4a',
    //'dataProvider'=>$model->search(),
    'dataProvider' => gTalentLeadershipCompetency::model()->search($model->id, $year),
    'type' => 'condensed',
    //'filter'=>$model,
    'template' => '{items}',
    //'extraRowColumns'=> array('level.name'),
    'columns' => [
        'year',
        //array(
        //	'header'=>'Period',
        //	'value' => '$data->getConvertTalentPeriod($data->period)',
        //),
        //'company_id',
        //array(
        //	'header'=>'Level',
        //	'name'=>'level.name',
        //),
        //'company_id',
        'talent_template.aspect',
        'talent_template.weight',
        [
            'name' => 'personal2_score',
        ],
        array(
            'name' => 'superior2_score',
        ),
        //'calcFinalResult',
        'remark',
        [
            'header' => 'Status',
            'name' => 'validate.name',
        ],
    ],
]);
?>

    <br/>

<?php
//if ($year == date('Y'))
//    echo $this->renderPartial('_formLeadershipCompetency', ['model' => $modelLeadershipCompetency, 'id' => $model->id, 'year' => $year]);
