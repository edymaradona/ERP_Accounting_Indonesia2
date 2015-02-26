<?php
$this->breadcrumbs = [
    'Person',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPerson']],
    ['label' => 'Home II', 'icon' => 'home', 'url' => ['/m1/gPerson/index']],
    ['label' => 'List of Uncomplete Data', 'icon' => 'th-list', 'url' => ['/m1/default/uncomplete']],
    ['label' => 'Birthday of the Month', 'icon' => 'th-list', 'url' => ['/m1/default/birthday']],
    ['label' => 'Probation / Contract', 'icon' => 'th-list', 'url' => ['/m1/default/probationcontract']],
    ['label' => 'Employee In / Out', 'icon' => 'th-list', 'url' => ['/m1/default/employeeinout']],
    ['label' => 'Black List', 'icon' => 'th-list', 'url' => ['/m1/default/blacklist']],
    ['label' => 'List Candidate Transfer', 'icon' => 'th-list', 'url' => ['/m1/gPerson/requestToEmployee']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = gPerson::getTopUpdatedCareer();
$this->menu2 = gPerson::getTopCreated();
//$this->menu4=gPerson::getTopOther();  //uncomplete data
$this->menu5 = ['Person'];

//$this->menu7=array(
//		array('label'=>'All','icon'=>'list','url'=>array('/m1/gPerson')),
//		array('label'=>'Sample Dept','icon'=>'list','url'=>'#'),
//);

$this->menu7 = aOrganization::compDeptPersonFilter();

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gPerson/index')];
?>


<div class="page-header">
    <h1>
        <i class="fa fa-user fa-fw"></i>
        Employee Data
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
    'dataProvider' => $dataProvider,
    'template' => '{items}{pager}',
    'itemView' => '/gPerson/_view',
    'htmlOptions' => [
        'style' => 'padding-top:0',
    ]
]);
?>

