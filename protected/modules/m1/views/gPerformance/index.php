<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu = [
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    //array('label' => 'Home', 'icon'=>'home', 'url' => array('/m1/gPerformance')),
    //array('label'=>'Report', 'icon'=>'print','url'=>array('/m1/gPerformance/report')),
];


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gPerformance/index')];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-flask fa-fw"></i>
            Performance
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbListView', [
    //$this->widget('ext.EColumnListView', array(
    //'columns' => 3,
    'dataProvider' => $dataProvider,
    'itemView' => '/gPerson/_view',
    'htmlOptions' => [
        'style' => 'padding-top:0',
    ]
]);

