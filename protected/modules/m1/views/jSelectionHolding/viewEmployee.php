<?php
$this->breadcrumbs = [
    'Applicant' => ['index'],
    $model->id,
];

$this->menu5 = ['Applicant'];
$this->menu7 = hApplicant::model()->topRecentApplicant;

$this->menu = [
    ['label' => 'Vacancy', 'icon' => 'home', 'url' => ['/m1/hVacancy']],
    ['label' => 'Applicant', 'icon' => 'user', 'url' => ['/m1/hApplicant']],
    ['label' => 'Selection Registration', 'icon' => 'tint', 'url' => ['/m1/jSelection']],
    ['label' => 'Interview', 'icon' => 'volume-up', 'url' => ['/m1/hVacancy/interview']],
    ['label' => 'Print CV', 'icon' => 'print', 'url' => ['printCv', 'id' => $model->id]],
    ['label' => 'Transfer', 'icon' => 'forward', 'url' => '#', 'linkOptions' => ['submit' => ['transfer', 'id' => $model->id], 'confirm' => 'Are you sure you want to transfer this employee to Person Administration?']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

<?php $this->beginContent('/layouts/column1N'); ?>


    <div class="page-header">
        <h1>
            <i class="fa fa-copy fa-fw"></i>
            <?php echo $model->employee_name; ?>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-3">
            <p><?php echo $model->photoPath; ?></p>
        </div>
        <div class="col-md-9">
            <?php
            $this->widget('booster.widgets.TbTabs', [
                'type' => 'tabs', // 'tabs' or 'pills'
                'tabs' => [
                    ['label' => 'Selection Process', 'content' => $this->renderPartial("/hApplicant/_tabSelection", ["model" => $model], true), 'active' => true],
                    ['label' => 'Employee Profile', 'content' => $this->renderPartial("/gPerson/_personalInfo", ["model" => $model], true)],
                    ['id' => 'tab4', 'label' => 'Career-Experience-Status', 'content' => $this->renderPartial("/gPerformance/_mainCareerExperienceStatus", ["model" => $model], true)],
                    ['id' => 'tab5', 'label' => 'Education', 'content' => $this->renderPartial("/gPerformance/_mainEducation", ["model" => $model], true)],
                ],
            ]);
            ?>

        </div>
    </div>


    <div class="page-header">
        <h3>New Process</h3>
    </div>

<?php //echo $this->renderPartial('_formSelection', array('model' => $modelSelection)); //}  ?>


<?php
$this->endContent();

