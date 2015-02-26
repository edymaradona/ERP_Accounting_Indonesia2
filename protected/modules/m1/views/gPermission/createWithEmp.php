<?php
$this->breadcrumbs = [
    'G Cutis' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPermission']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    //array('label'=>'Manage gPerson','url'=>array('admin')),
];

//$this->menu1=gPermission::getTopUpdated();
//$this->menu2=gPermission::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-medkit fa-fw"></i>
            Create Permission
        </h1>
    </div>


<?php
echo $this->renderPartial('_formWithEmp', ['model' => $model]);
