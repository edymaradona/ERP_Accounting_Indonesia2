<?php //if (isset($model->company->department_id)):                 ?>

    <h4>
        List of Subordinate
    </h4>
<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person1-grid',
    'dataProvider' => gPerson::model()->subOrdinate($model->id),
    'enableSorting' => false,
    'template' => '{items}{pager}',
    'htmlOptions' => ['style' => 'padding-top:0'],
    'columns' => [
        [
            'type' => 'raw',
            'value' => 'CHtml::link($data->PhotoPath,Yii::app()->createUrl("' . $this->route . '/../view",array("id"=>$data->id,)))',
            'htmlOptions' => ["width" => "60px"],
        ],
        [
            'header' => 'Name',
            'type' => 'raw',
            'value' => function ($data) {
                    return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->GPersonLink)
                    //. CHtml::tag('div', array('style'=>'color: #999; font-size: 11px'), $data->employee_code)
                    . CHtml::tag('div', [], $data->mJobTitle())
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->mLevel());
                },
            'visible' => $this->id == "gPerson",
        ],
        [
            'header' => 'Name',
            'type' => 'raw',
            'value' => function ($data) {
                    return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->GTalentLink)
                    //. CHtml::tag('div', array('style'=>'color: #999; font-size: 11px'), $data->employee_code)
                    . CHtml::tag('div', [], $data->mJobTitle())
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->mLevel());
                },
            'visible' => $this->id == "gPerformance",
        ],
    ],
]);
?>

<?php //endif;

