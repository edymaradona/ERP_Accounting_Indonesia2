<?php
$this->breadcrumbs = [
    'Person Holding',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/iLearning']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

<div class="page-header">
    <h1>
        <i class="fa fa-print fa-fw"></i>
        Report
    </h1>
</div>

<ul>
    <li>
        <?php echo CHtml::link('Training by Employee', Yii::app()->createUrl('/m1/iLearning/report2')); ?>
    </li>
    <li>
        <?php echo CHtml::link('Training by Month (' . date("Y") . ')', Yii::app()->createUrl('/m1/iLearning/report3')); ?>
    </li>
</ul>
