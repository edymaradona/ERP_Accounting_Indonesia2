<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPerformanceHolding']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    //array('label'=>'Update', 'icon'=>'edit', 'url'=>array('update', 'id'=>$model->id)),
    //array('label'=>'Delete', 'icon'=>'remove', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),),
];


//$this->menu1 = gPerson::getTopUpdated();
//$this->menu2 = gPerson::getTopCreated();

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gPerformance/index')];
?>

<?php /*
  <div class="pull-right">
  <?php $this->widget('booster.widgets.TbButtonGroup', array(
  'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
  'buttons'=>array(
  array('label'=>'Person', 'items'=>array(
  array('label'=>'Leave', 'url'=>Yii::app()->createUrl("/m1/gLeave/view",array("id"=>$model->id))),
  array('label'=>'Absence', 'url'=>'#'),
  array('label'=>'Payroll', 'url'=>'#'),
  array('label'=>'Other Module', 'url'=>'#'),
  )),
  ),
  )); ?>
  </div>
 */
?>

<div class="page-header">
    <h1>
        <i class="fa fa-flask fa-fw"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-3">
        <?php echo $model->PhotoPath; ?>

        <div style="text-align:center; padding:10px 0">
            <?php echo CHtml::link('Print Profile', Yii::app()->createUrl('/m1/gPerformance/printProfile', ['id' => $model->id]), ['class' => 'btn btn-primary btn-xs', 'target' => '_blank'])
            ?>
        </div>
    </div>
    <div class="col-md-9">
        <?php echo $this->renderPartial('/gPerson/_personalInfo', ['model' => $model]); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => [
                ['id' => 'tab40', 'label' => 'Performance Appraisal', 'items' => [
                    ['id' => 'tab41', 'label' => 'KPI', 'content' => $this->renderPartial("_tabTargetSetting2", ["model" => $model, "year" => $year], true), 'visible' => $model->mGolonganId() >= 10, 'active' => true],
                    ['id' => 'tab44', 'label' => 'Work Result', 'content' => $this->renderPartial("/gPerformance/_tabWorkResult2", ["model" => $model, "year" => $year], true), 'visible' => $model->mGolonganId() < 10, 'active' => true],
                    ['id' => 'tab42', 'label' => 'Core Competency', 'content' => $this->renderPartial("/gPerformance/_tabCoreCompetency2", ["model" => $model, "year" => $year], true)],
                    ['id' => 'tab43', 'label' => 'Leadership Competency', 'content' => $this->renderPartial("/gPerformance/_tabLeadershipCompetency2", ["model" => $model, "year" => $year], true), 'visible' => $model->mGolonganId() >= 7],
                ]],
                ['id' => 'tab50', 'label' => 'Potential', 'items' => [
                    ['id' => 'tab52', 'label' => 'Competency Profile', 'content' => $this->renderPartial("/gPerformance/_tabCompetencyProfile", ["model" => $model, "year" => $year], true)],
                    ['id' => 'tab51', 'label' => 'Potential', 'content' => $this->renderPartial("/gPerformance/_tabPotential", ["model" => $model, "year" => $year], true)],
                ]],
                ['id' => 'tab30', 'label' => 'Final Rating', 'content' => $this->renderPartial("/gPerformance/_tabFinalRating", ["model" => $model], true),
                    'visible' => (Yii::app()->user->checkAccess('HR Performance Final Rating') || Yii::app()->user->name == "admin")],
                ['id' => 'tab7', 'label' => 'Personal Info', 'items' => [
                    ['id' => 'tab4', 'label' => 'Profile', 'content' => $this->renderPartial("/gPerformance/_mainCareerExperienceStatus", ["model" => $model], true)],
                    ['id' => 'tab5', 'label' => 'Education', 'content' => $this->renderPartial("/gPerformance/_mainEducation", ["model" => $model], true)],
                    //array('id' => 'tab7', 'label' => 'Detail', 'content' => $this->renderPartial("/gPerson/_personalInfo", array("model" => $model), true)),
                ]],
                ['id' => 'tab40', 'label' => 'Upload Documents', 'content' => $this->renderPartial("/gPerformance/_tabUpload", ["model" => $model], true)],
            ],
        ]);
        ?>
    </div>
</div>


<hr/>

