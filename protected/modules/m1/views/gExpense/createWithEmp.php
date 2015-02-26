<?php
$this->breadcrumbs = [
    'G Cutis' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gExpense']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    //array('label'=>'Manage gPerson','url'=>array('admin')),
];

//$this->menu1=gExpense::getTopUpdated();
//$this->menu2=gExpense::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            Create Travel / Return to Homebase
        </h1>
    </div>


<?php
echo $this->renderPartial('_formWithEmp', ['model' => $model]);
