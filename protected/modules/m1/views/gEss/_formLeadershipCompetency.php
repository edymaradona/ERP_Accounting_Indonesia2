<div class="page-header">
    <h3>New Leadership Competency (<?php echo $year ?>)</h3>
</div>


<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-target-setting-form',
    'enableAjaxValidation' => false,
]);
?>


<?php //echo $form->dropDownListGroup($model,'year',gTalentPerformance::getTalentPeriod());  ?>


<?php
//echo $form->dropDownListGroup($model,'company_id',[],
//array('class'=>'col-md-5','maxlength'=>50));
?>


<?php echo $form->dropDownListGroup($model, 'talent_template_id', ['widgetOptions' => [
    'data' => gParamCompetency::leadershipDropDown()
]]);
?>

<?php echo $form->textFieldGroup($model, 'personal_score'); ?>

<?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 5]]]); ?>


<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?php
        $this->widget('booster.widgets.TbButton', [
            'buttonType' => 'submit',
            'context' => 'primary',
            'icon' => 'fa fa-check',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ]);
        ?>



        <?php /* $this->widget('booster.widgets.TbButton', array(
      'type'=>'primary',
      'url'=>Yii::app()->createUrl('/m1/gPerformance/generateLeadershipCompetency',array('id'=>$id,'year'=>$year)),
      'label'=>'Generate All',
      )); */
        ?>

    </div>
</div>

<?php $this->endWidget(); ?>
