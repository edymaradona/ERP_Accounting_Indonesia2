<?php
if (isset($forum))
    $this->widget('zii.widgets.CBreadcrumbs', [
        'links' => array_merge(
            $forum->getBreadcrumbs(true), ['New thread']
        ),
    ]);
else
    $this->widget('zii.widgets.CBreadcrumbs', [
        'links' => array_merge(
            $thread->getBreadcrumbs(true), ['New reply']
        ),
    ]);
?>

<div class="form" style="margin:20px;">
    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 'post-form',
        'type' => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions' => [
            'validateOnSubmit' => true,
        ],
    ]);
    ?>

    <?php if (isset($forum)): ?>
        <?php echo $form->textFieldGroup($model, 'subject'); ?>
    <?php endif; ?>

    <?php echo $form->textAreaGroup($model, 'content', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>
</div>

<?php if (Yii::app()->user->name == "admin"): ?>
    <?php echo $form->checkBoxGroup($model, 'lockthread', ['uncheckValue' => 0]); ?>
<?php endif; ?>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
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
</div><!-- form -->
