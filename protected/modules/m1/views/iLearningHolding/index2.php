<?php
/* @var $this ILearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'I Learnings',
];

$this->menu = [
    ['label' => 'Learning Calendar', 'icon' => 'briefcase', 'url' => ['/m1/iLearningHolding']],
    ['label' => 'List By Date', 'icon' => 'briefcase', 'url' => ['/m1/iLearningHolding/index3']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu5 = ['Sylabus'];
?>


    <div class="pull-right">
        <?php
        $this->renderPartial('_search', [
            'model' => $model,
        ]);
        ?>
    </div>

    <div class="page-header">
        <h1>
            <i class="fa fa-book fa-fw"></i>
            Learning List
        </h1>
    </div>


<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
