<?php
$this->breadcrumbs = [
    'Applicant' => ['index'],
    $model->id,
];

//$this->menu5 = array('Applicant');
//$this->menu7 = hApplicant::model()->topRecentApplicant;

$this->menu = [
    ['label' => 'Vacancy', 'icon' => 'home', 'url' => ['/m1/hVacancy']],
    ['label' => 'Applicant', 'icon' => 'user', 'url' => ['/m1/hApplicant']],
    ['label' => 'Selection Registration', 'icon' => 'tint', 'url' => ['/m1/jSelection']],
    ['label' => 'Interview', 'icon' => 'volume-up', 'url' => ['/m1/hVacancy/interview']],
    ['label' => 'Print CV', 'icon' => 'print', 'url' => ['printCv', 'id' => $model->id]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    //array('label' => 'Transfer', 'icon' => 'forward', 'url' => '#', 'linkOptions' => array('submit' => array('transfer', 'id' => $model->id), 'confirm' => 'Are you sure you want to transfer this employee to Person Administration?')),
];
?>

<?php $this->beginContent('/layouts/column1N'); ?>


    <div class="page-header">
        <h1>
            <i class="fa fa-copy fa-fw"></i>
            <?php echo $model->applicant_name; ?>
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
                    ['label' => 'Candidate Profile', 'content' => $this->renderPartial("/hApplicant/_tabDetail", ["model" => $model], true)],
                ],
            ]);
            ?>

        </div>
    </div>

<?php
$this->endContent();

