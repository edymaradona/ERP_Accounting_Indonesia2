<?php
/* @var $this ILearningController */
/* @var $model iLearning */

$this->breadcrumbs = [
    'I Learnings' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'Learning Calendar', 'icon' => 'briefcase', 'url' => ['/m1/iLearningHolding']],
    ['label' => 'List By Subject', 'icon' => 'briefcase', 'url' => ['/m1/iLearningHolding/index2']],
    ['label' => 'List By Date', 'icon' => 'calendar', 'url' => ['/m1/iLearningHolding/index3']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-book fa-fw"></i>
            Update: <?php echo $model->learning_title; ?>
        </h1>
    </div>



<?php
echo $this->renderPartial('_form', ['model' => $model]);
