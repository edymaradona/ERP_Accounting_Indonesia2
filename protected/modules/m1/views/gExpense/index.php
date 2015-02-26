<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gExpense']],
    //array('icon' => 'calendar', 'label' => 'Expense Calendar', 'url' => array('/m1/gExpense/expenseCalendar')),
    //array('icon' => 'print', 'label' => 'Weekly Insurance Report', 'url' => array('/m1/gExpense/weeklyReport')),
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = [
    //array('icon' => 'print', 'label' => 'Expense Reports ', 'url' => array('/m1/gExpense/reportByDept')),
];


//$this->menu1=gExpense::getTopUpdated();
//$this->menu2=gExpense::getTopCreated();
$this->menu5 = ['Travel / Return to Homebase'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gExpense/list')];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            Travel / Return to Homebase
        </h1>
    </div>

<?php
//$this->renderPartial('_search', [
//    'model' => $model,
//]);
?>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Waiting for Approval', 'url' => Yii::app()->createUrl('/m1/gExpense'), 'active' => true],
        ['label' => 'Realization Detail', 'url' => Yii::app()->createUrl('/m1/gExpense/onRealization')],
        ['label' => 'Finance', 'url' => Yii::app()->createUrl('/m1/gExpense/onProcess')],
        ['label' => 'Recent Travel / Return to Homebase', 'url' => Yii::app()->createUrl('/m1/gExpense/onRecent')],
    ],
    'htmlOptions' => [
    ]
]);
?>

<?php
echo $this->renderPartial('onWaiting', ['model' => $model]);
