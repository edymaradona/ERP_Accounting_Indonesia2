<?php
/* @var $this JSelectionController */
/* @var $model jSelection */

$this->breadcrumbs = [
    'J Selections' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-tasks fa-fw"></i>
            Create</h1>
    </div>

<?php
echo $this->renderPartial('_form', ['model' => $model]);
