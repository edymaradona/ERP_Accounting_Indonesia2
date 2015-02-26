<?php
/* @var $this JSelectionController */
/* @var $model jSelection */

$this->breadcrumbs = [
    'J Selections' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/jSelectionHolding']],
    ['label' => 'View', 'icon' => 'pencil', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-tasks fa-fw"></i>
            Update</h1>
    </div>

<?php
echo $this->renderPartial('_form', ['model' => $model]);
