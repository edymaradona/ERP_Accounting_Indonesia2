<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker4', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'identity_valid') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		'changeMonth' : true,
        'changeYear' : true,
		'yearRange' : '" . date("Y", strtotime("-65 year")) . ":" . date("Y", strtotime("-15 year")) . "',
});
			
});

		");
?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'g-person-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>

<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-12">
            <?php /*
          <?php $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
          'legend'=>'Basic Info'
          )); ?>

          <?php echo $form->textFieldGroup($model,'employee_code',[]); ?>

          <?php echo $form->textFieldGroup($model,'employee_name',[]); ?>

          <?php echo $form->textFieldGroup($model,'birth_place',[]); ?>

          <?php echo $form->textFieldGroup($model,'birth_date'); ?>

          <?php echo $form->dropDownListGroup($model,'sex_id',sParameter::items("cGender")); ?>

          <?php echo $form->dropDownListGroup($model,'religion_id',sParameter::items("cAgama")); ?>

          <?php $this->endWidget(); ?><!-- collabsible fieldset -->
         */
            ?>
            <?php
            //$this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
            //    'legend' => 'Address'
            //));
            ?>
            <?php //echo $form->textAreaGroup($model, 'address1', array('rows' => 4, 'class' => 'col-md-5')); ?>

            <?php //echo $form->textFieldGroup($model,'address2',[]); ?>

            <?php //echo $form->textFieldGroup($model,'address3',[]); ?>

            <?php //echo $form->textFieldGroup($model, 'pos_code', array('class' => 'col-md-2')); ?>

            <?php //$this->endWidget(); ?><!-- collabsible fieldset -->

            <?php
            //$this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
            //    'legend' => 'Identity'
            //));
            ?>
            <?php //echo $form->textFieldGroup($model, 'identity_number', array('class' => 'col-md-3')); ?>

            <?php //echo $form->textFieldGroup($model, 'identity_valid'); ?>

            <?php //echo $form->textAreaGroup($model, 'identity_address1', array('rows' => 4, 'class' => 'col-md-5')); ?>

            <?php //echo $form->textFieldGroup($model,'identity_address2',[]); ?>

            <?php //echo $form->textFieldGroup($model,'identity_address3',[]); ?>

            <?php //echo $form->textFieldGroup($model, 'identity_pos_code', array('class' => 'col-md-2')); ?>

            <?php //$this->endWidget(); ?><!-- collabsible fieldset -->

            <?php
            $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', [
                'legend' => 'Contact'
            ]);
            ?>
            <?php echo $form->emailFieldGroup($model, 'email'); ?>

            <?php //echo $form->textFieldGroup($model, 'email2', array('class' => 'col-md-3')); ?>

            <?php echo $form->textFieldGroup($model, 'blood_id'); ?>

            <?php echo $form->textFieldGroup($model, 'home_phone'); ?>

            <?php echo $form->textFieldGroup($model, 'handphone'); ?>

            <?php //echo $form->textFieldGroup($model, 'handphone2', array('class' => 'col-md-3')); ?>

            <?php $this->endWidget(); ?><!-- collabsible fieldset -->

            <?php
            $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', [
                'legend' => 'Bank'
            ]);
            ?>
            <?php echo $form->textFieldGroup($model, 'account_number', []); ?>

            <?php echo $form->textFieldGroup($model, 'account_name', []); ?>

            <?php echo $form->textFieldGroup($model, 'bank_name', []); ?>

            <?php $this->endWidget(); ?><!-- collabsible fieldset -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

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
        </div>
    </div>

<?php
$this->endWidget();
