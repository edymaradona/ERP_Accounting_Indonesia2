<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPerson']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();

$this->message = '<strong>Aware!</strong> Please, check for posibility re-entry the existing or resigned employee. Contact Holding for more information...';
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-user fa-fw"></i>
            Create
        </h1>
    </div>


<?php
echo $this->renderPartial('_form', ['model' => $model, 'modelCareer' => $modelCareer, 'modelStatus' => $modelStatus]);
