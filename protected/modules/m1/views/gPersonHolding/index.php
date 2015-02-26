<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPersonHolding']],
    ['label' => 'Report', 'icon' => 'print', 'url' => ['/m1/gPersonHolding/report']],
    ['label' => 'Request to Mutation', 'icon' => 'user', 'url' => ['/m1/default2/requestMutation']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();

//$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gPersonHolding/index'));
?>

<div class="row">
    <div class="col-md-12">

        <div class="page-header">
            <h1>
                <i class="fa fa-user fa-fw"></i>
                Person View
            </h1>
        </div>

        <?php
        $this->renderPartial('_search', [
            'model' => $model,
        ]);
        ?>

        <?php
        $this->widget('booster.widgets.TbListView', [
            //$this->widget('ext.EColumnListView', array(
            //'columns' => 3,
            'dataProvider' => $dataProvider,
            'itemView' => '/gPerson/_view',
        ]);
        ?>

    </div>
</div>
