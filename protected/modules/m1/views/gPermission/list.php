<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPermission']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
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
$this->widget('booster.widgets.TbListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
