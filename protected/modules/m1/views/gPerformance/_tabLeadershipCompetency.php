<br/>
<?php
$this->widget('booster.widgets.TbButton', [
    'context' => 'primary',
    'buttonType' => 'link',
    'icon' => 'fa fa-check',
    'url' => Yii::app()->createUrl('/m1/gPerformance/generateLeadershipCompetency', ['id' => $model->id, 'year' => $year]),
    'label' => 'Generate Leadership Competency for: ' . $year,
]);
?>
<br/>
<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-leadership-competency-grid4a',
    //'dataProvider'=>$model->search(),
    'dataProvider' => gTalentLeadershipCompetency::model()->search($model->id, $year),
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
        'talent_template.weight',
        'talent_template.target',
        'remark',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerformance/deleteLeadershipCompetency",array("id"=>$data->id))',
        ],
        [
            'header' => 'Created Date/By',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->created->username
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], date('d-m-Y', ($data->created_date)));
                }
        ],
    ],
]);
?>

<?php

//echo $this->renderPartial('_formLeadershipCompetency', ['model' => $modelLeadershipCompetency, 'id' => $model->id, 'year' => $year]);
