<?php
$this->widget('zii.widgets.CBreadcrumbs', [
    'links' => array_merge(
        $model->getBreadcrumbs(!$model->isNewRecord), [$model->isNewRecord ? 'New forum' : 'Edit']
    )
]);
?>
<div class="form" style="margin:20px;">
    <?php $form = $this->beginWidget('TbActiveForm'); ?>

    <div class="form-group">
        <?php echo $form->label($model, 'parent_id', ['class' => 'control-label']); ?>
        <?php
        echo CHtml::activeDropDownList($model, 'parent_id', CHtml::listData(
            Forum::model()->findAll(), 'id', 'title'
        ), ['empty' => 'None (root)', 'class' => 'form-control']);
        ?>
    </div>

    <?php echo $form->textFieldGroup($model, 'title'); ?>
    <?php echo $form->textAreaGroup($model, 'description', ['rows' => 10, 'cols' => 70]); ?>
    <?php echo $form->textFieldGroup($model, 'listorder'); ?>
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
