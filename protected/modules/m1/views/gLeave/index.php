<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLeave']],
    ['icon' => 'calendar', 'label' => 'Leave Calendar', 'url' => ['/m1/gLeave/leaveCalendar']],
];

$this->menu = [
    ['icon' => 'cog', 'label' => 'Create New Cancellation Leave', 'url' => ['/m1/gLeave/cancellation']],
    ['icon' => 'cog', 'label' => 'Create New Extended Leave', 'url' => ['/m1/gLeave/extended']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = [
    ['icon' => 'print', 'label' => 'Leave Reports ', 'url' => ['/m1/gLeave/reportByDept']],
];

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
$onwaiting = (gLeave::model()->onWaiting()->totalItemCount != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], gLeave::model()->onWaiting()->totalItemCount) : "";
$onsuperior = (gLeave::model()->onSuperior()->totalItemCount != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], gLeave::model()->onSuperior()->totalItemCount) : "";
$onapproved = (gLeave::model()->onApproved()->totalItemCount != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], gLeave::model()->onApproved()->totalItemCount) : "";
$onleave = (gLeave::model()->onLeave()->totalItemCount != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], gLeave::model()->onLeave()->totalItemCount) : "";

$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'encodeLabel' => false,
    'tabs' => [
        ['label' => 'Waiting for Approval ' . $onwaiting, 'url' => Yii::app()->createUrl('/m1/gLeave'), 'active' => true],
        ['label' => 'Approved By Superior ' . $onsuperior, 'url' => Yii::app()->createUrl('/m1/gLeave/onSuperior')],
        ['label' => 'Approved Leave ' . $onapproved, 'url' => Yii::app()->createUrl('/m1/gLeave/onApproved')],
        ['label' => 'Employee On Leave ' . $onleave, 'url' => Yii::app()->createUrl('/m1/gLeave/onLeave')],
        ['label' => 'Recent Leave', 'url' => Yii::app()->createUrl('/m1/gLeave/onRecent')],
    ],
    'htmlOptions' => [
    ]
]);
?>

<?php
echo $this->renderPartial('onWaiting', ['model' => $model]);
