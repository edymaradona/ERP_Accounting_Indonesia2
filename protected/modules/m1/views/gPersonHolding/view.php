<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPersonHolding']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();

//$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gPerson/index'));
?>

<?php
$this->renderPartial('_search', [
    'model' => $model,
]);
?>


<div class="page-header">
    <h1>
        <i class="fa fa-user fa-fw"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-3">
        <?php echo $model->PhotoPath; ?>

        <div style="text-align:center; padding:10px 0">
            <?php echo CHtml::link('Print Profile', Yii::app()->createUrl('/m1/gPersonHolding/printProfile', ['id' => $model->id]), ['class' => 'btn btn-primary btn-xs', 'target' => '_blank'])
            ?>
        </div>


    </div>
    <div class="col-md-9">
        <?php echo $this->renderPartial('/gPerson/_personalInfo', ['model' => $model]); ?>

        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => [
                //array('id'=>'tab1','label'=>'Performance','content'=>$this->renderPartial("_tabPerformance", array("model"=>$model,"modelPerformance"=>$modelPerformance), true),'active'=>true),
                //array('id'=>'tab2','label'=>'Potential','content'=>$this->renderPartial("_tabPotential", array("model"=>$model,"modelPotential"=>$modelPotential), true)),
                ['id' => 'tab3', 'label' => 'Career-Experience-Status', 'content' => $this->renderPartial("_mainCareerExperienceStatus", ["model" => $model], true), 'active' => true],
                ['id' => 'tab4', 'label' => 'Education', 'content' => $this->renderPartial("_mainEducation", ["model" => $model], true)],
                ['id' => 'tab8', 'label' => 'Training ', 'content' => $this->renderPartial("_mainTraining", ["model" => $model], true)],
                ['id' => 'tab5', 'label' => 'Family', 'content' => $this->renderPartial("/gPerson/_tabFamily", ["model" => $model], true)],
                ['id' => 'tab6', 'label' => 'Detail', 'content' => $this->renderPartial("/gPerson/_tabDetail", ["model" => $model], true)],
            ],
        ]);
        ?>

    </div>
</div>

<hr/>

<div class="row">
    <div class="col-md-6">
        <?php //echo $this->renderPartial('/gPerson/_sameDepartment',array('model'=>$model));  ?>
    </div>
    <div class="col-md-6">
        <?php //echo $this->renderPartial('/gPerson/_sameLevel',array('model'=>$model));  ?>
    </div>
</div>
