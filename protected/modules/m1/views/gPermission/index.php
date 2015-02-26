<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPermission']],
    ['icon' => 'calendar', 'label' => 'Permission Calendar', 'url' => ['/m1/gPermission/permissionCalendar']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = [
    ['icon' => 'print', 'label' => 'Permission Reports ', 'url' => ['/m1/gPermission/reportByDept']],
];


//$this->menu1=gPermission::getTopUpdated();
//$this->menu2=gPermission::getTopCreated();
$this->menu5 = ['Permission'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gPermission/list')];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-medkit fa-fw"></i>
            Permission
        </h1>
    </div>

<?php
$this->renderPartial('_search', [
    'model' => $model,
]);
?>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Waiting for Approval', 'url' => Yii::app()->createUrl('/m1/gPermission'), 'active' => true],
        ['label' => 'Approved By Superior', 'url' => Yii::app()->createUrl('/m1/gPermission/onSuperior')],
        ['label' => 'Approved Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onApproved')],
        ['label' => 'Employee On Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onPermission')],
        ['label' => 'Recent Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onRecent')],
    ],
    'htmlOptions' => [

    ]
]);
?>

<?php
echo $this->renderPartial('onWaiting', ['model' => $model]);
