<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

<div class="page-header">
    <h1>
        <i class="fa fa-user fa-fw"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-3">
        <?php
        echo $model->photoPath;
        ?>

        <div style="font-size:11px">Data Completeness <span
                class="pull-right strong"><?php echo peterFunc::indoFormat($model->completion, 0) ?>%</span>
            <?php
            $this->widget('booster.widgets.TbProgress', [
                'context' => 'success', // 'info', 'success' or 'danger'
                'percent' => $model->completion,
                'htmlOptions' => [
                    'style' => 'height:7px',
                ]
            ]);
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
        $carC = ($model->many_careerC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_careerC) : "";
        $staC = ($model->many_statusC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_statusC) : "";
        $expC = ($model->many_experienceC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_experienceC) : "";
        $eduC = ($model->many_educationC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_educationC) : "";
        $famC = ($model->many_familyC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_familyC) : "";
        $othC = ($model->many_otherC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_otherC) : "";
        $edunfC = ($model->many_educationnfC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_educationnfC) : "";
        $traC = ($model->many_trainingC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_trainingC) : "";

        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'encodeLabel' => false,
            'tabs' => [
                ['label' => 'Detail', 'content' => $this->renderPartial("/gPerson/_tabDetail", ["model" => $model], true), 'active' => true],
                ['label' => 'Career ' . $carC . ' - Experience ' . $expC . ' - Status ' . $staC, 'content' => $this->renderPartial("/gPersonHolding/_mainCareerExperienceStatus", ["model" => $model], true)],
                //array('label'=>'Internal Career'.$carC,'content'=>$this->renderPartial("/gPerson/_tabCareer", array("model"=>$model), true)),
                //array('label'=>'Experience'.$expC,'content'=>$this->renderPartial("/gPerson/_tabExperience", array("model"=>$model), true)),
                //array('label'=>'Status'.$staC,'content'=>$this->renderPartial("/gPerson/_tabStatus", array("model"=>$model), true)),
                ['label' => 'Education ' . $eduC, 'content' => $this->renderPartial("/gPersonHolding/_mainEducation", ["model" => $model], true)],
                //array('label'=>'Education'.$eduC,'content'=>$this->renderPartial("/gPerson/_tabEducation", array("model"=>$model), true)),
                //array('label'=>'Non Formal Education'.$edunfC,'content'=>$this->renderPartial("/gPerson/_tabEducationNf", array("model"=>$model), true)),
                ['label' => 'Training ' . $traC, 'content' => $this->renderPartial("/gPersonHolding/_mainTraining", ["model" => $model], true)],
                ['label' => 'Family ' . $famC, 'content' => $this->renderPartial("/gPerson/_tabFamily", ["model" => $model], true)],
                ['label' => 'Other ' . $othC, 'content' => $this->renderPartial("/gPerson/_tabOther", ["model" => $model, "modelOther" => $modelOther], true)],
            ],
        ]);
        ?>

        <?php $this->renderPartial('_sameDepartmentE', ['model' => $model]); ?>

    </div>
</div>
