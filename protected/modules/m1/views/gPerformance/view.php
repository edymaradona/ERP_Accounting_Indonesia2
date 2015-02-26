<?php if (Yii::app()->request->getParam("tab") != null): ?>

    <script>

        $(document).ready(function () {
            $('#tabs a:contains("<?php echo Yii::app()->request->getParam("tab"); ?>")').tab('show');
        });

    </script>

<?php endif; ?>


<?php
$this->breadcrumbs = [
    'Home Performance' => ['/m1/gPerformance'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPerformance']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    //array('label'=>'Update', 'icon'=>'edit', 'url'=>array('update', 'id'=>$model->id)),
    //array('label'=>'Delete', 'icon'=>'remove', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),),
];


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();

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

<div class="row">
    <div class="col-md-9">

        <div class="page-header">
            <h1>
                <i class="fa fa-flask fa-fw"></i>
                <?php echo $model->employee_name; ?>
            </h1>
        </div>

        <?php $this->renderPartial('/gPerformance/_talentDashboard', ['model' => $model, 'year' => $year]) ?>

    </div>
    <div class="col-md-3">
        <?php
        $this->renderPartial('_search', [
            'model' => $model,
            'year' => $year,
        ]);
        ?>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbTabs', [
            'justified' => true,
            'type' => 'pills',
            'tabs' => [
                ['label' => '<< Previous Year', 'url' => Yii::app()->createUrl("/m1/gPerformance/view", ["id" => $model->id, "year" => $year - 1])],
                ['label' => $year,
                    'url' => Yii::app()->createUrl("/m1/gPerformance/view", ["id" => $model->id, "year" => $year])],
                ['label' => 'Next Year >>',
                    'url' => Yii::app()->createUrl("/m1/gPerformance/view", ["id" => $model->id, "year" => $year + 1]),
                    'itemOptions' => ($year == date("Y")) ? ['class' => 'disabled'] : ['class' => '']
                ],
            ],
        ]);
        ?>

        <br/>

        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => [
                ['id' => 'tab70', 'label' => 'Target Setting', 'active' => true, 'items' => [
                    ['id' => 'tab73', 'label' => 'KPI', 'content' => $this->renderPartial("_tabTargetSetting1", ["model" => $model, "modelTargetSetting" => $modelTargetSetting, "year" => $year], true), 'visible' => $model->mGolonganId() >= 10, 'active' => true],
                    ['id' => 'tab74', 'label' => 'Work Result', 'content' => $this->renderPartial("_tabWorkResult", ["model" => $model, "modelWorkResult" => $modelWorkResult, "year" => $year], true), 'visible' => $model->mGolonganId() < 10, 'active' => true],
                    ['id' => 'tab71', 'label' => 'Core Competency', 'content' => $this->renderPartial("_tabCoreCompetency", ["model" => $model, "modelCoreCompetency" => $modelCoreCompetency, "year" => $year], true)],
                    ['id' => 'tab72', 'label' => 'Leadership Competency', 'content' => $this->renderPartial("_tabLeadershipCompetency", ["model" => $model, "modelLeadershipCompetency" => $modelLeadershipCompetency, "year" => $year], true), 'visible' => $model->mGolonganId() >= 7],
                ]],
                ['id' => 'tab40', 'label' => 'Performance Appraisal', 'items' => [
                    ['id' => 'tab41', 'label' => 'KPI', 'content' => $this->renderPartial("_tabTargetSetting2", ["model" => $model, "modelPerformanceP" => $modelPerformanceP, "year" => $year], true), 'visible' => $model->mGolonganId() >= 10],
                    ['id' => 'tab44', 'label' => 'Work Result', 'content' => $this->renderPartial("_tabWorkResult2", ["model" => $model, "modelWorkResult" => $modelWorkResult, "year" => $year], true), 'visible' => $model->mGolonganId() < 10],
                    ['id' => 'tab42', 'label' => 'Core Competency', 'content' => $this->renderPartial("_tabCoreCompetency2", ["model" => $model, "modelCoreCompetency" => $modelCoreCompetency, "year" => $year], true)],
                    ['id' => 'tab43', 'label' => 'Leadership Competency', 'content' => $this->renderPartial("_tabLeadershipCompetency2", ["model" => $model, "modelLeadershipCompetency" => $modelLeadershipCompetency, "year" => $year], true), 'visible' => $model->mGolonganId() >= 7],
                ]],
                //['id' => 'tab50', 'label' => 'Potential', 'items' => [
                    ['id' => 'tab51', 'label' => 'Potential', 'content' => $this->renderPartial("_tabPotential", ["model" => $model, "modelPotential" => $modelPotential, "year" => $year], true)],
                //]],
                ['id' => 'tab30', 'label' => 'Final Rating', 'content' => $this->renderPartial("_tabFinalRating", ["model" => $model, "modelFinalRating" => $modelFinalRating], true),
                    'visible' => (Yii::app()->user->checkAccess('HR Performance Final Rating') || Yii::app()->user->name == "admin")],
                ['id' => 'tab7', 'label' => 'Personal Info', 'items' => [
                    ['id' => 'tab4', 'label' => 'Profile', 'content' => $this->renderPartial("_mainCareerExperienceStatus", ["model" => $model], true)],
                    ['id' => 'tab5', 'label' => 'Education', 'content' => $this->renderPartial("_mainEducation", ["model" => $model], true)],
                    //array('id' => 'tab7', 'label' => 'Detail', 'content' => $this->renderPartial("/gPerson/_personalInfo", array("model" => $model), true)),
                ]],
                ['id' => 'tab40', 'label' => 'Upload Documents', 'content' => $this->renderPartial("_tabUpload", ["model" => $model], true)],
                ['id' => 'tab50', 'label' => 'Training', 'content' => $this->renderPartial("/gPerson/_mainTraining", ["model" => $model], true)],
            ],
        ]);
        ?>
    </div>
</div>


<hr/>

<?php $this->renderPartial('/gPerson/_sameDepartment', ['model' => $model]); ?>
