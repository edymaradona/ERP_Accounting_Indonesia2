<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gMedical']],
    ['label' => 'Medical Calendar', 'icon' => 'calendar', 'url' => ['/m1/gMedical/medicalCalendar']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = [
    ['label' => 'Report to Insurance/Finance', 'icon' => 'print', 'url' => ['/m1/gMedical/weeklyReport']],
    ['label' => 'Medical Reports', 'icon' => 'print', 'url' => ['/m1/gMedical/reportByDept']],
];


$this->menu5 = ['Medical'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gMedical/list')];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-medkit fa-fw"></i>
            Medical
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
        ['label' => 'Waiting for Process', 'url' => Yii::app()->createUrl('/m1/gMedical'), 'active' => true],
        ['label' => 'Insurance/Finance', 'url' => Yii::app()->createUrl('/m1/gMedical/onProcess')],
        ['label' => 'Recent Medical', 'url' => Yii::app()->createUrl('/m1/gMedical/onRecent')],
    ],
    'htmlOptions' => [
    ]
]);
?>

<?php
echo $this->renderPartial('onWaiting', ['model' => $model]);
