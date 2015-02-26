<?php
$this->breadcrumbs = [
    'G Cutis' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPermission']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

//$this->menu1=gPermission::getTopUpdated();
//$this->menu2=gPermission::getTopCreated();
$this->menu5 = ['Permission'];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-medkit fa-fw"></i>
            Update:
            <?php echo $model->person->employee_name; ?>
        </h1>
    </div>



<?php
echo $this->renderPartial('_formUpdate', ['model' => $model]);
