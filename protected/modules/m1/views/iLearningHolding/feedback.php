<?php
/* @var $this ILearningController */
/* @var $model iLearning */
/* @var $form CActiveForm */
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-book fa-fw"></i>
            Feedback: <?php echo $modelSch->employee->employee_name; ?>
        </h1>


        <h3>
            On: <?php echo $modelSch->getparent->getparent->learning_title . " :: " . $modelSch->getparent->schedule_date ?> </h3>
    </div>


<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'i-learning-feedback',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-4">
            <?php echo $form->textFieldGroup($model, 'A1'); ?>
            <?php echo $form->textFieldGroup($model, 'A2'); ?>
            <?php echo $form->textFieldGroup($model, 'A3'); ?>
            <?php echo $form->textFieldGroup($model, 'A4'); ?>
            <?php echo $form->textFieldGroup($model, 'A5'); ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->textFieldGroup($model, 'B1'); ?>
            <?php echo $form->textFieldGroup($model, 'B2'); ?>
            <?php echo $form->textFieldGroup($model, 'B3'); ?>
            <?php echo $form->textFieldGroup($model, 'B4'); ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->textFieldGroup($model, 'C1'); ?>
            <?php echo $form->textFieldGroup($model, 'C2'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?php echo $form->textAreaGroup($model, 'D1'); ?>
            <?php echo $form->textAreaGroup($model, 'D2'); ?>
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'submit',
                'icon' => 'fa fa-check',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ]);
            ?>

        </div>
    </div>
<?php
$this->endWidget();









            