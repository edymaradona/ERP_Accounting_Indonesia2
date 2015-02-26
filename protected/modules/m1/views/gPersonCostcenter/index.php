<?php
$this->breadcrumbs = [
    'Person',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/kPayroll']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();


$this->menu7 = aOrganization::compDeptPayrollFilter();

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gPersonCostcenter/index')];
?>


<div class="page-header">
    <h1>
        <i class="fa fa-user fa-fw"></i>
        Cost Center
    </h1>
</div>

<?php
if (isset($_GET['pid'])) {
    if ((int)$_GET['pid'] != 0) {
        echo "<p style='display: block;margin: 5px 0;padding: 10px;background-color: #EAEFFF;'>";
        echo "Filter By Directorate/Department: " . aOrganization::model()->findByPk((int)$_GET['pid'])->name;
        echo "</p>";
    }
}
?>

<?php
$this->widget('booster.widgets.TbListView', [
    //$this->widget('ext.EColumnListView', array(
    //'span' => 3,
    //'columns'=>2,
    'dataProvider' => $dataProvider,
    'template' => '{items}{pager}',
    'itemView' => '/gPerson/_view',
    'htmlOptions' => [
        'style' => 'padding-top:0',
    ]
]);
?>

