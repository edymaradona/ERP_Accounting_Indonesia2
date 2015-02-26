<?php
/* @var $this ILearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'I Learnings',
];

$this->menu = [
    ['label' => 'Learning Calendar', 'url' => ['/m1/iLearning']],
    ['label' => 'List By Date', 'url' => ['/m1/iLearning/index3']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


//$this->menu5=array('Sylabus');
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-book fa-fw"></i>
            Learning List
        </h1>
    </div>


<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
