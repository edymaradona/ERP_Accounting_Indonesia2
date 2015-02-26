<?php
/* @var $this SAddressbookController */
/* @var $model sAddressbook */
/* @var $form CActiveForm */

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . "/css/select2-3.4.1/select2.js");
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . "/css/select2-3.4.1/select2.css");


Yii::app()->clientScript->registerScript('sel2', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'member_of') . "\" ).select2(
			{tags:" . sAddressbookGroup::model()->getGroupList() . "}
		);

		$( \"textarea#" . CHtml::activeId($model, 'message') . "\" ).maxlength({
			alwaysShow: true
		});

		});


");
?>


<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 's-addressbook-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'complete_name', ['class' => 'col-md-4']); ?>
<?php echo $form->textFieldGroup($model, 'title', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldGroup($model, 'handphone', ['hint' => 'start with number 8 or 21 AND not +62 or 0', 'prepend' => '+62', 'class' => 'col-md-3']); ?>
<?php echo $form->textFieldGroup($model, 'company_name', ['class' => 'col-md-6']); ?>
<?php echo $form->textAreaGroup($model, 'address', ['class' => 'col-md-5', 'rows' => 3]); ?>
<?php echo $form->textFieldGroup($model, 'email', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldGroup($model, 'member_of', ['class' => 'col-md-9']); ?>
<br/>

<div class="control-group">
    <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="fa fa-check fa-fw"></i>Create' : '<i class="fa fa-check fa-fw"></i>Save', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>

