<?php
$this->widget('zii.widgets.CBreadcrumbs', [
    'links' => array_merge(
        $model->thread->getBreadcrumbs(true), ['Edit post']
    ),
]);
?>

<div class="form" style="margin:20px;">
    <?php
    $form = $this->beginWidget('CActiveForm', [
        'id' => 'post-form',
        'enableClientValidation' => true,
        'clientOptions' => [
            'validateOnSubmit' => true,
        ],
    ]);
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php echo $form->textArea($model, 'content', ['rows' => 10, 'cols' => 70]); ?>
        <?php echo $form->error($model, 'content'); ?>
        <p class="hint">
            Hint: You can
            use <?php echo CHtml::link('markdown', 'http://daringfireball.net/projects/markdown/syntax'); ?> syntax!
        </p>
    </div>

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
