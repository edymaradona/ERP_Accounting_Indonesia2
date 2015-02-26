<?php
/* @var $this ILearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'I Learnings',
];

$this->menu = [
    ['label' => 'Learning Calendar', 'url' => ['/m1/iLearning']],
    ['label' => 'List By Subject', 'url' => ['/m1/iLearning/index2']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


//$this->menu5=array('Sylabus');
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-book fa-fw"></i>
            Learning List by Date
        </h1>
    </div>



<?php
$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 'i-learning-sch-grid',
    'dataProvider' => iLearningSch::model()->searchByDate(),
    //'filter'=>$model,
    'columns' => [
        [
            'name' => 'schedule_date',
            'type' => 'raw',
            'value' => 'CHtml::link($data->schedule_date,Yii::app()->createUrl("/m1/iLearning/viewDetail",array("id"=>$data->id)))',
        ],
        [
            'header' => 'Subject',
            'type' => 'raw',
            'value' => 'CHtml::link($data->getparent->learning_title,Yii::app()->createUrl("/m1/iLearning/view",array("id"=>$data->parent_id)))',
        ],
        'trainer_name',
        'location',
        'additional_info',
        [
            'name' => 'status_id',
            'value' => '$data->status->name',
        ],
        //array(
        //	'class'=>'CButtonColumn',
        //),
    ],
]);

