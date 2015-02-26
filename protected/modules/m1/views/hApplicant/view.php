<?php
$this->breadcrumbs = [
    'Applicant' => ['index'],
    $model->id,
];

$this->menu5 = ['Applicant'];
//$this->menu7 = hApplicant::model()->topRecentApplicant;
$this->menu11 = hApplicantExperience::getJobTitleCloud();

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


<div class="page-header">
    <h1>
        <i class="fa fa-copy fa-fw"></i>
        <?php echo $model->applicant_name; ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-3">
        <p><?php echo $model->photoPath; ?></p>

        <?php
        $this->widget('ext.DzRaty.DzRaty', [
            'name' => 'id',
            //'id'=>'star'.$model->id,
            'value' => (isset($model->systemrating)) ? $model->systemrating->rating : 0,
            //'data' => array(1,2,3,4,5,6,7,8,9,10,11,12),
            'options' => [
                'readOnly' => TRUE,
            ],
            //'htmlOptions' => array(
            //	'class' => 'pull-right'
            //),
        ]);
        ?>

    </div>
    <div class="col-md-9">
        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => [
                ['label' => 'Selection Process', 'content' => $this->renderPartial("/hApplicant/_tabSelection", ["model" => $model], true), 'active' => true],
                ['label' => 'Candidate Profile', 'content' => $this->renderPartial("/hApplicant/_tabDetail", ["model" => $model], true)],
                ['id' => 'tab2', 'label' => 'Create New', 'items' => [
                    ['label' => 'Experience', 'content' => $this->renderPartial("_tabExperience", ["model" => $model, "modelExperience" => $modelExperience], true)],
                    ['label' => 'Education', 'content' => $this->renderPartial("_tabEducation", ["model" => $model, "modelEducation" => $modelEducation], true)],
                    ['label' => 'Family', 'content' => $this->renderPartial("_tabFamily", ["model" => $model, "modelFamily" => $modelFamily], true)],
                    ['label' => 'Non Formal Education', 'content' => $this->renderPartial("_tabEducationNf", ["model" => $model, "modelEducationNf" => $modelEducationNf], true)],
                ]],
            ],
        ]);
        ?>

    </div>
</div>


<div class="page-header">
    <h3>New Process</h3>
</div>

<?php echo $this->renderPartial('_formSelection', ['model' => $modelSelection, "modelApplicant" => $model]); //}   ?>


