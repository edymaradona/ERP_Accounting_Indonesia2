<style>
.fb-profile img.fb-image-lg{
    z-index: 0;
    width: 100%;  
    margin-bottom: 10px;
}

.fb-image-profile
{
    margin: -90px 10px 0px 50px;
    z-index: 9;
    width: 20%; 
}

@media (max-width:768px)
{
    
.fb-profile-text>h1{
    font-weight: 700;
    font-size:16px;
}

.fb-image-profile
{
    margin: -45px 10px 0px 25px;
    z-index: 9;
    width: 20%; 
}
}
</style>

<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

    <div class="fb-profile">
        <img align="left" class="fb-image-lg" src="http://lorempixel.com/850/280/nightlife/5/" alt="Profile image example"/>
        <?php echo $model->photoPath; ?><br/>
        <div class="fb-profile-text">
            <h1><?php echo $model->employee_name; ?></h1>
            <?php echo $this->renderPartial('/gPerson/_personalInfo', ['model' => $model]); ?>
        </div>
    </div>

<br/>

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
