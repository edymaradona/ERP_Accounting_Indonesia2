<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */

$this->breadcrumbs = [
//	'Register'=>array('index'),
//	'Create',
];

$this->menu = [
];
?>


<div class="page-header">
    <h1>
        <i class="fa fa-user fa-fw"></i>
        ESS (Employee Self Service) Registration</h1>
</div>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 's-user-registration-form',
    'enableAjaxValidation' => true,
    //'type'=>'horizontal',
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'username', ['class' => 'col-md-4', 'hint' => 'You are free to select your own username login. Username that will be easy to remember']); ?>
<?php echo $form->textFieldGroup($model, 'activation_code', ['class' => 'col-md-4', 'hint' => 'ask your activation code to HR Manager']); ?>
<?php echo $form->passwordFieldGroup($model, 'password', ['class' => 'col-md-3', 'hint' => 'input your password and do not forget']); ?>
<?php echo $form->passwordFieldGroup($model, 'password_repeat', ['class' => 'col-md-3', 'hint' => 'input your password once again']); ?>

<?php /*
  <?php if (extension_loaded('gd')): ?>

  <?php echo $form->labelEx($model, 'verifyCode'); ?>
  <div>
  <?php $this->widget('CCaptcha', array('clickableImage' => true)); ?>
  <?php echo CHtml::tag('div', [], $form->textField($model, 'verifyCode')); ?>
  </div>

  <?php endif; ?>
 */
?>

<div class="control-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check fa-fw"></i>Submit', ['class' => 'btn btn-primary', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>
