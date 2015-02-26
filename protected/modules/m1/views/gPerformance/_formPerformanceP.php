<div class="row">
    <div class="col-md-12">


        <div class="page-header">
            <h3>New Performance Process</h3>
        </div>

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'g-performance-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>


        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'individual_weight'); ?>
        <?php echo $form->textFieldGroup($model, 'individual_target'); ?>
        <?php echo $form->textFieldGroup($model, 'individual_value'); ?>
        <?php echo $form->textFieldGroup($model, 'superior_value'); ?>
        <?php echo $form->textFieldGroup($model, 'superior_weight'); ?>
        <?php echo $form->textAreaGroup($model, 'remark', ['rows' => 3, 'class' => 'col-md-4']); ?>

        <div class="form-group">
            <div class="col-sm-3">
                <?php
                $this->widget('booster.widgets.TbButton', [
                    'buttonType' => 'submit',
                    'context' => 'primary',
                    'icon' => 'fa fa-check',
                    'label' => 'Create',
                ]);
                ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div>
</div>

