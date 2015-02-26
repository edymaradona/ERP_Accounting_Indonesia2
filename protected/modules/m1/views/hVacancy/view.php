<?php

$this->breadcrumbs = [
    'G Vacancies' => ['index'],
    $model->id,
];


Yii::app()->clientScript->registerScript('campaign', "
$('.campaign-button').click(function(){
	$('.campaign-block').toggle('slow');
	return false;
});
$('.detail-link').click(function(){
	$('.detail-block').toggle('slow');
	return false;
});

");


$this->menu7 = hVacancy::model()->topRecentVacancy;

$this->menu = [
    ['label' => 'Vacancy', 'icon' => 'home', 'url' => ['/m1/hVacancy']],
    ['label' => 'Applicant', 'icon' => 'user', 'url' => ['/m1/hApplicant']],
    ['label' => 'Selection Registration', 'icon' => 'tint', 'url' => ['/m1/jSelection']],
    ['label' => 'Interview', 'icon' => 'volume-up', 'url' => ['/m1/hVacancy/interview']],
    ['label' => 'Update', 'icon' => 'edit', 'url' => ['/m1/hVacancy/update', 'id' => $model->id]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    //array('label'=>'Broadcast', 'icon'=>'envelope', 'url'=>array('/m1/hVacancy/broadcast','id'=>$model->id)),
];
$this->menu4 = hVacancyApplicant::model()->topRecentInterview;
$this->menu8 = hApplicant::model()->topRecentApplicant;
?>

<div class="page-header">
    <h1>
        <i class="fa fa-paperclip fa-fw"></i>
        <?php
        echo $model->vacancy_title;
        ?>

    </h1>
</div>

<?php
$this->renderPartial('_tabCampaign', ['model' => $model]);
?>


<?php echo CHtml::link('Show/Hide Detail', '#', ['class' => 'detail-link pull-right']); ?>
<?php echo CHtml::link('Show/Hide New Campaign', '#', ['class' => 'campaign-button btn btn-xs']); ?>

<div class="campaign-block" style="display:none">
    <?php
    $this->renderPartial('_formCampaign', ['model' => $modelCampaign]);
    ?>
</div>


<div class="detail-block" style="display:none">
    <?php echo $model->vacancy_desc; ?>

    <?php
    //$this->widget('ext.expander.Expander',array(
    //  'content'=>$model->vacancy_desc,
    //  'config'=>array('slicePoint'=>50, 'expandText'=>'read more', 'userCollapseText'=>'read less', 'preserveWords'=>false)
    //));
    ?>
    <br/>

    <b><?php echo CHtml::encode($model->getAttributeLabel('company_id')); ?>:</b>
    <?php echo CHtml::encode($model->company->name); ?>
    <br/>


    <div style="font-size:11px">
        <b><?php echo CHtml::encode($model->getAttributeLabel('industry_tag')); ?>:</b>
        <?php echo CHtml::encode($model->industry_tag); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('for_level')); ?>:</b>
        <?php echo CHtml::encode($model->for_level); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('city')); ?>:</b>
        <?php echo CHtml::encode($model->city); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('min_working_exp')); ?>:</b>
        <?php echo CHtml::encode($model->min_working_exp); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('min_education_level')); ?>:</b>
        <?php echo CHtml::encode($model->edulevel->name); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('min_gpa')); ?>:</b>
        <?php echo CHtml::encode($model->min_gpa); ?>
        <br/>

        <b><?php echo "Salary (Rp)"; ?>:</b>
        <?php echo peterFunc::indoFormat($model->min_salary) . " - " . peterFunc::indoFormat($model->max_salary); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('salary_hide')); ?>:</b>
        <?php echo ($model->salary_hide) ? "Yes" : "No"; ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('work_address')); ?>:</b>
        <?php echo CHtml::encode($model->work_address); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('specification_tag')); ?>:</b>
        <?php echo CHtml::encode($model->specification_tag); ?> |

        <?php //echo nl2br($model->skill_required);  ?>
        <br/>
    </div>

</div>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => [
        ['id' => 'tab1', 'label' => 'First Pool  (' . $model->screened([11, 12]) . ')', 'content' => $this->renderPartial("_tabFirstpool", ["model" => $model], true), 'active' => true],
        ['id' => 'tab2', 'label' => 'Invitation (' . $model->screened([21, 22, 23]) . ')', 'items' => [
            ['id' => 'tab21', 'label' => 'Invitation HR (' . $model->screened([21]) . ')', 'content' => $this->renderPartial("_tabInvitationhr", ["model" => $model], true)],
            ['id' => 'tab22', 'label' => 'Invitation User (' . $model->screened([22]) . ')', 'content' => $this->renderPartial("_tabInvitationuser", ["model" => $model], true)],
            ['id' => 'tab22', 'label' => 'Invitation Psycho/Technical (' . $model->screened([23]) . ')', 'content' => $this->renderPartial("_tabInvitationtech", ["model" => $model], true)],
        ]],
        ['id' => 'tab30', 'label' => 'Interview (' . $model->screened([31, 32]) . ')', 'items' => [
            ['id' => 'tab31', 'label' => 'HR (' . $model->screened([31]) . ')', 'content' => $this->renderPartial("_tabInterviewhr", ["model" => $model], true)],
            ['id' => 'tab32', 'label' => 'User (' . $model->screened([32]) . ')', 'content' => $this->renderPartial("_tabInterviewuser", ["model" => $model], true)],
        ]],
        ['id' => 'tab40', 'label' => 'Test (' . $model->screened([41, 42]) . ')', 'items' => [
            ['id' => 'tab41', 'label' => 'Psycho (' . $model->screened([41]) . ')', 'content' => $this->renderPartial("_tabPsychotest", ["model" => $model], true)],
            ['id' => 'tab42', 'label' => 'Technical (' . $model->screened([42]) . ')', 'content' => $this->renderPartial("_tabTechnicaltest", ["model" => $model], true)],
        ]],
        ['id' => 'tab5', 'label' => 'Salary Nego (' . $model->screened([52]) . ')', 'content' => $this->renderPartial("_tabSalary", ["model" => $model], true)],
        ['id' => 'tab6', 'label' => 'LoO (' . $model->screened([53]) . ')', 'content' => $this->renderPartial("_tabLoo", ["model" => $model], true)],
        ['id' => 'tab7', 'label' => 'Transfer (' . $model->screened([54]) . ')', 'content' => $this->renderPartial("_tabTransfer", ["model" => $model], true)],
    ],
]);
?>

<div id="detail">
    <?php
    if (isset($modelApplicant)) {
        $this->renderPartial('_detailApplicant', [
            'modelApplicant' => $modelApplicant,
        ]);
    }
    ?>
</div>