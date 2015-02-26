<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLeave']],
    ['icon' => 'calendar', 'label' => 'Leave Calendar', 'url' => ['/m1/gLeave/leaveCalendar']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


//$this->menu1=gLeave::getTopUpdated();
//$this->menu2=gLeave::getTopCreated();
$this->menu5 = ['Leave'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gLeave/list')];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-suitcase fa-fw"></i>
            Leave
        </h1>
    </div>

<?php
//$this->renderPartial('_search', [
//    'model' => $model,
//]);
?>

<?php
$this->widget('booster.widgets.TbListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'htmlOptions' => [
        'style' => 'padding-top:0',
    ],
]);
