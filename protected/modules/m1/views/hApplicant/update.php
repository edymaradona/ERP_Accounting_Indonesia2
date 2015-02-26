<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];


$this->menu5 = ['Applicant'];
$this->menu7 = hApplicant::model()->topRecentApplicant;

$this->menu = [
    ['label' => 'Vacancy', 'icon' => 'home', 'url' => ['/m1/hVacancy']],
    ['label' => 'Applicant', 'icon' => 'user', 'url' => ['/m1/hApplicant']],
    ['label' => 'Selection Registration', 'icon' => 'tint', 'url' => ['/m1/jSelection']],
    ['label' => 'Interview', 'icon' => 'volume-up', 'url' => ['/m1/hVacancy/interview']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

<?php $this->beginContent('/layouts/column1N'); ?>

    <div class="page-header">
        <h1>
            <i class="fa fa-copy fa-fw"></i>
            <?php echo $model->applicant_name; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>

<?php
$this->endContent();
