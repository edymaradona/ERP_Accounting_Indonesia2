<?php
$this->beginWidget('booster.widgets.TbPanel', [
    'title' => false,
    'headerIcon' => 'fa fa-globe fa-fw',
        'htmlOptions' => [
            'class' => 'panel-info',
        ]
]);
?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'login-form',
    //'type'=>'horizontal',
    //'enableAjaxValidation'=>true,
    'clientOptions' => [
        'validateOnSubmit' => true,
    ],
]);
?>

<?php echo $form->textFieldGroup($model, 'username'); ?>

<?php echo $form->passwordFieldGroup($model, 'password'); ?>

<?php if ($model->getIsNeedCaptcha()): ?>
    <?php if (extension_loaded('gd')): ?>
        <?php echo $form->captchaRow($model, 'verifyCode'); ?>
    <?php endif; ?>
<?php endif; ?>

<?php //echo $form->checkBoxRow($model,'rememberMe');  ?>

<p>
    <?php
    if (Yii::app()->params['selfregistration'])
        echo "Are you employee? " . CHtml::link('register here', Yii::app()->createUrl('site/register'));
    ?>
</p>

<?php //echo CHtml::htmlButton('<i class="fa fa-check fa-fw"></i>Submit', ['class' => 'btn btn-primary', 'type' => 'submit','block'=>true]); ?>
<?php
$this->widget('booster.widgets.TbButton', [
    'context' => 'primary',
    'block'=>true,
    'buttonType' => 'submit',
    'icon' => 'fa fa-check fa-fw',
    'label' => 'Submit',
]);
?>


<?php $this->endWidget(); ?>

<?php $this->endWidget(); ?>

