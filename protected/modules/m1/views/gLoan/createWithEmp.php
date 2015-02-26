<?php
$this->breadcrumbs = [
    'G Cutis' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLoan']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    //array('label'=>'Manage gPerson','url'=>array('admin')),
];

//$this->menu1=gLoan::getTopUpdated();
//$this->menu2=gLoan::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            Create Loan
        </h1>
    </div>


<?php
echo $this->renderPartial('_formWithEmp', ['model' => $model]);
