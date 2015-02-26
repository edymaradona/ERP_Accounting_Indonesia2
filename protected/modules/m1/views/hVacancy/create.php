<?php
/* @var $this HVacancyController */
/* @var $model hVacancy */

$this->breadcrumbs = [
    'H Vacancies' => ['index'],
    'Create',
];

$this->menu7 = hVacancy::model()->topRecentVacancy;

$this->menu10 = [
    ['label' => 'Vacancy', 'icon' => 'home', 'url' => ['/m1/hVacancy']],
    ['label' => 'Applicant', 'icon' => 'user', 'url' => ['/m1/hApplicant']],
    ['label' => 'Selection Registration', 'icon' => 'tint', 'url' => ['/m1/jSelection']],
    ['label' => 'Interview', 'icon' => 'volume-up', 'url' => ['/m1/hVacancy/interview']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
$this->menu4 = hVacancyApplicant::model()->topRecentInterview;
$this->menu8 = hApplicant::model()->topRecentApplicant;
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-paperclip fa-fw"></i>
            Create</h1>
    </div>
<?php
//echo $this->renderPartial('_form', array('model'=>$model,'modelSch'=>$modelSch));
echo $this->renderPartial('_form', ['model' => $model]);
