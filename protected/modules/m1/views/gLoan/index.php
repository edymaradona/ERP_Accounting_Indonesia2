<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLoan']],
    ['icon' => 'calendar', 'label' => 'Loan Calendar', 'url' => ['/m1/gLoan/loanCalendar']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = [
    //array('icon' => 'print', 'label' => 'Loan Reports ', 'url' => array('/m1/gLoan/reportByDept')),
];


//$this->menu1=gLoan::getTopUpdated();
//$this->menu2=gLoan::getTopCreated();
$this->menu5 = ['Loan'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gLoan/list')];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            Loan
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
        ['label' => 'Waiting for Process', 'url' => Yii::app()->createUrl('/m1/gLoan'), 'active' => true],
        ['label' => 'Outstanding', 'url' => Yii::app()->createUrl('/m1/gLoan/onOutstanding')],
        ['label' => 'Paid', 'url' => Yii::app()->createUrl('/m1/gLoan/onPaid')],
    ],
    'htmlOptions' => [
    ]
]);
?>

<?php
echo $this->renderPartial('onWaiting', ['model' => $model]);
