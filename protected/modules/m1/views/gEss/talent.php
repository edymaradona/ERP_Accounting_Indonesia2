<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

<div class="page-header">
    <h1>
        <i class="fa fa-leaf fa-fw"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>

<?php $this->renderPartial('/gPerformance/_talentDashboard', ['model' => $model, 'year' => $year]) ?>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'justified' => true,
    'tabs' => [
        ['label' => '<< Previous Year', 'url' => Yii::app()->createUrl("/m1/gEss/talent", ["year" => $year - 1])],
        ['label' => $year,
            'url' => Yii::app()->createUrl("/m1/gEss/talent", ["year" => $year])],
        //['label' => 'Next Year >>', 'visible' => ($year != date("Y")), 'url' => Yii::app()->createUrl("/m1/gEss/talent", ["year" => $year + 1])],
        ['label' => 'Next Year >>',
            'url' => Yii::app()->createUrl("/m1/gPerformance/view", ["id" => $model->id, "year" => $year + 1]),
            'itemOptions' => ($year == date("Y")) ? ['class' => 'disabled'] : ['class' => '']
        ],
    ],
    'htmlOptions' => [
    ]
]);
?>

<br/>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => [
                ['id' => 'tab41', 'label' => 'KPI', 'content' => $this->renderPartial("_tabTalentTargetSetting2", ['modelTargetSetting' => $modelTargetSetting, "model" => $model, "year" => $year], true), 'visible' => $model->mGolonganId() >= 10, 'active' => true],
                ['id' => 'tab44', 'label' => 'Work Result', 'content' => $this->renderPartial("_tabTalentWorkResult2", ["model" => $model, "year" => $year], true), 'visible' => $model->mGolonganId() < 10, 'active' => true],
                ['id' => 'tab42', 'label' => 'Core Competency', 'content' => $this->renderPartial("_tabTalentCoreCompetency2", ['modelCoreCompetency' => $modelCoreCompetency, "model" => $model, "year" => $year], true)],
                ['id' => 'tab43', 'label' => 'Leadership Competency', 'content' => $this->renderPartial("_tabTalentLeadershipCompetency2", ['modelLeadershipCompetency' => $modelLeadershipCompetency, "model" => $model, "year" => $year], true)],
            ],
        ]);
        ?>
    </div>
</div>


<hr/>
