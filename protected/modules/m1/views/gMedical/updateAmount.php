<style>
    input[type=number] {
        height: 30px;
    }
</style>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
        $( \"#" . CHtml::activeId($model, 'receipt_date') . "\" ).datepicker({
        'dateFormat' : 'dd-mm-yy',
    });
        
        
});

        ");
?>

<?php
$this->breadcrumbs = [
    'G Cutis' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gMedical']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

//$this->menu1=gMedical::getTopUpdated();
//$this->menu2=gMedical::getTopCreated();
$this->menu5 = ['Medical'];
?>

<div class="page-header">
    <h1>
        <i class="fa fa-medkit fa-fw"></i>
        Update:
        <?php echo $model->person->employee_name; ?>
    </h1>
</div>



<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-cuti-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'receipt_date'); ?>

<?php echo $form->dropDownListGroup($model, 'medical_for_id', ['widgetOptions' => [
    'data' => gMedical::medicalFamilyDropDown($model->parent_id)
]]); ?>

<?php echo $form->dropDownListGroup($model, 'medical_type_id', ['widgetOptions' => [
    'data' => gParamMedical::medicalDropDownAll()
]]); ?>

<?php echo $form->textAreaGroup($model, 'sympthom', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>

<?php echo $form->numberFieldGroup($model, 'general_doctor', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->numberFieldGroup($model, 'specialist_doctor', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->numberFieldGroup($model, 'medicine', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->numberFieldGroup($model, 'doctor_medicine', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->numberFieldGroup($model, 'administration', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->numberFieldGroup($model, 'physiotherapy', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->numberFieldGroup($model, 'diagnostics', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->numberFieldGroup($model, 'original_amount', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>


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
    </div>
</div>
<?php
$this->endWidget();

