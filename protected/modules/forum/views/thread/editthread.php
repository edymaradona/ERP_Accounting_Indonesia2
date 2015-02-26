<?php
$this->widget('zii.widgets.CBreadcrumbs', [
    'links' => array_merge(
        $model->getBreadcrumbs(true), ['Edit']
    ),
]);
?>

<div class="form" style="margin:20px;">
    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 'thread-form',
        'enableClientValidation' => true,
        'clientOptions' => [
            'validateOnSubmit' => true,
        ],
    ]);
    ?>

    <?php echo $form->textFieldGroup($model, 'subject'); ?>
    <?php echo $form->checkBoxGroup($model, 'is_sticky', ['uncheckValue' => 0]); ?>
    <?php echo $form->checkBoxGroup($model, 'is_locked', ['uncheckValue' => 0]); ?>

    <div class="form-group">
        <div class="col-sm-3">
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
    <?php $this->endWidget(); ?>
</div><!-- form -->
