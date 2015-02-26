<br/>
<?php
$this->widget('booster.widgets.TbButton', [
    'context' => 'primary',
    'buttonType' => 'link',
    'icon' => 'fa fa-check',
    'url' => Yii::app()->createUrl('/m1/gPerformance/generateCoreCompetency', ['id' => $model->id, 'year' => $year]),
    'label' => 'Generate Core Competency for: ' . $year,
]);
?>
<br/>

<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-core-competency-grid4a',
    //'dataProvider'=>$model->search(),
    'dataProvider' => gTalentCoreCompetency::model()->search($model->id, $year),
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
            'class' => 'booster.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerformance/deleteCoreCompetency",array("id"=>$data->id))',
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

//echo $this->renderPartial('_formCoreCompetency', ['model' => $modelCoreCompetency, 'id' => $model->id, 'year' => $year]);
