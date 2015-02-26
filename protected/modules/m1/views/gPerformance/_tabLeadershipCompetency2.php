<br/>

<?php if ($model->mGolonganId() >= 10) { ?>

    <h4>Semester I</h4>

<?php
//$this->widget('booster.widgets.TbGridView',array(
    $this->widget('booster.widgets.TbGroupGridView', [
        'id' => 'g-leadership-competency-grid24a',
        //'dataProvider'=>$model->search(),
        'dataProvider' => gTalentLeadershipCompetency::model()->search($model->id, $year),
        'type' => 'condensed',
        //'filter'=>$model,
        'template' => '{items}',
        'extraRowColumns' => ['level.name'],
        'columns' => [
            'year',
            //array(
            //	'header'=>'Period',
            //	'value' => '$data->getConvertTalentPeriod($data->period)',
            //),
            //'company_id',
            [
                'header' => 'Level',
                'name' => 'level.name',
            ],
            //'company_id',
            'talent_template.aspect',
            'talent_template.weight',
            [
                'class' => 'booster.widgets.TbEditableColumn',
                'name' => 'personal_score',
                'sortable' => false,
                'editable' => [
                    'url' => $this->createUrl('/m1/gPerformance/updateLeadershipCompetencyAjax'),
                    //'placement' => 'right',
                    'inputclass' => 'col-md-1'
                ]],
            [
                'class' => 'booster.widgets.TbEditableColumn',
                'name' => 'superior_score',
                'sortable' => false,
                'editable' => [
                    'url' => $this->createUrl('/m1/gPerformance/updateLeadershipCompetencyAjax'),
                    //'placement' => 'right',
                    'inputclass' => 'col-md-1'
                ]],
            'calcFinalResult',
            'remark',
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

<?php } ?>

<?php
if ($model->mGolonganId() >= 10) {
    echo CHtml::tag('h4', [], 'Semester II');
} else
    echo CHtml::tag('h4', [], 'All Year');

?>

<?php
//$this->widget('booster.widgets.TbGridView',array(
$this->widget('booster.widgets.TbGroupGridView', [
    'id' => 'g-leadership-competency-grid4b',
    //'dataProvider'=>$model->search(),
    'dataProvider' => gTalentLeadershipCompetency::model()->search($model->id, $year),
    'type' => 'condensed',
    //'filter'=>$model,
    'template' => '{items}',
    'extraRowColumns' => ['level2.name'],
    'columns' => [
        'year',
        //array(
        //	'header'=>'Period',
        //	'value' => '$data->getConvertTalentPeriod($data->period)',
        //),
        //'company_id',
        [
            'header' => 'Level',
            'name' => 'level2.name',
        ],
        //'company_id',
        'talent_template.aspect',
        'talent_template.weight',
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'personal2_score',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateLeadershipCompetencyAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'superior2_score',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gPerformance/updateLeadershipCompetencyAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        'calcFinalResult2',
        'remark',
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
