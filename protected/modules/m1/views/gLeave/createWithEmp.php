<?php
$this->breadcrumbs = [
    'G Cutis' => ['index'],
    'Create',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLeave']],
    ['icon' => 'calendar', 'label' => 'Leave Calendar', 'url' => ['/m1/gLeave/leaveCalendar']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

//$this->menu1=gLeave::getTopUpdated();
//$this->menu2=gLeave::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-suitcase fa-fw"></i>
            Create Leave
        </h1>
    </div>


<?php
echo $this->renderPartial('_formWithEmp', ['model' => $model]);
