<style>
    .userautocompletelink {
        height: 52px;
    }

    .userautocompletelink img {
        float: left;
        margin-right: 5px;
        width: 40px;
    }

</style>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
//        ->registerScriptFile(Yii::app()->baseUrl . "/css/bootstrapFormHelpers/js/bootstrap-formhelpers-phone.js")
//        ->registerScriptFile(Yii::app()->baseUrl . "/css/bootstrapFormHelpers/js/bootstrap-formhelpers-phone.format.js");


Yii::app()->clientScript->registerScript('datepicker4', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'birth_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		'changeMonth' : true,
        'changeYear' : true,
		'yearRange' : '" . date("Y", strtotime("-65 year")) . ":" . date("Y", strtotime("-15 year")) . "',
		});
		
		$( \"#" . CHtml::activeId($model, 'identity_valid') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		'changeMonth' : true,
        'changeYear' : true,
		'yearRange' : '" . date("Y") . ":" . date("Y", strtotime("+20 year")) . "',
		});
		
		$( \"#" . CHtml::activeId($model, 'employee_name') . "\" ).autocomplete({
			'minLength' : 7,
			'source': ' " . Yii::app()->createUrl('/m1/gPerson/personAutoCompletePhotoCreate') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'employee_name') . "\").val(ui.item.employee_name);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'employee_name') . "\").val(ui.item.employee_name);
			return false;
			},
			
		})
		.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\")
			.data( \"item.autocomplete\", item )
			.append('<a class=\'userautocompletelink\'><img src=\'" . Yii::app()->baseUrl . "/shareimages/hr/employee/thumb/" . "'+item.photo+'\'/><h5>'+item.label+'</h5></a>')
			.appendTo( ul );
		};
		
		
		});

        $( \"#" . CHtml::activeId($model, 'address2') . "\" ).autocomplete({
            'minLength' : 4,
            'source': ' " . Yii::app()->createUrl('/site/address2AutoComplete') . "',
            'focus': function( event, ui ) {
            $(\"#" . CHtml::activeId($model, 'address2') . "\").val(ui.item.address3);
            return false;
            },
            'select': function( event, ui ) {
            $(\"#" . CHtml::activeId($model, 'address2') . "\").val(ui.item.address2a);
            $(\"#" . CHtml::activeId($model, 'address3') . "\").val(ui.item.address3);
            return false;
            },
            
        })
        .data( \"autocomplete\" )._renderItem = function( ul, item ) {
            return $( \"<li></li>\")
            .data( \"item.autocomplete\", item )
            .append('<a ><h5>'+item.address2+'</h5></a>')
            .appendTo( ul );
        };

        $( \"#" . CHtml::activeId($model, 'address3') . "\" ).autocomplete({
            'minLength' : 4,
            'source': ' " . Yii::app()->createUrl('/site/address3AutoComplete') . "',
            'focus': function( event, ui ) {
            $(\"#" . CHtml::activeId($model, 'address3') . "\").val(ui.item.address3);
            return false;
            },
            'select': function( event, ui ) {
            $(\"#" . CHtml::activeId($model, 'address3') . "\").val(ui.item.address3);
            return false;
            },
            
        })
        .data( \"autocomplete\" )._renderItem = function( ul, item ) {
            return $( \"<li></li>\")
            .data( \"item.autocomplete\", item )
            .append('<a ><h5>'+item.address3+'</h5></a>')
            .appendTo( ul );
        };


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
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', [
            'legend' => 'Basic Info',
            'fieldsetHtmlOptions' => ['style' => 'padding:12px'],
        ]);
        ?>

        <div class="row">
            <div class="col-md-6">
                <?php echo $form->textFieldGroup($model, 'employee_name'); ?>

                <?php echo $form->textFieldGroup($model, 'employee_code'); ?>

                <?php echo $form->textFieldGroup($model, 'birth_place'); ?>

                <?php echo $form->textFieldGroup($model, 'birth_date'); ?>

            </div>
            <div class="col-md-6">
                <?php echo $form->dropDownListGroup($model, 'sex_id', ['widgetOptions' => [
                    'data' => sParameter::items("cGender")
                ]]); ?>

                <?php echo $form->dropDownListGroup($model, 'religion_id', ['widgetOptions' => [
                    'data' => sParameter::items("cAgama")
                ]]); ?>

                <?php echo $form->textFieldGroup($model, 'blood_id', ['class' => 'col-md-1']); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', [
            'legend' => 'Address',
            'fieldsetHtmlOptions' => ['style' => 'padding:12px'],
        ]);
        ?>
        <?php echo $form->textAreaGroup($model, 'address1', ['class' => 'col-md-4', 'rows' => 5]); ?>

        <?php echo $form->textFieldGroup($model,'address2',[]); ?>

        <?php echo $form->textFieldGroup($model,'address3',[]);  ?>

        <?php echo $form->textFieldGroup($model, 'pos_code', ['class' => 'col-md-2']); ?>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->


    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', [
            'legend' => 'Identity',
            'fieldsetHtmlOptions' => ['style' => 'padding:12px'],
        ]);
        ?>
        <?php echo $form->textFieldGroup($model, 'identity_number', []); ?>

        <?php echo $form->textFieldGroup($model, 'identity_valid'); ?>

        <?php echo $form->textAreaGroup($model, 'identity_address1', ['class' => 'col-md-4', 'rows' => 5]); ?>

        <?php //echo $form->textFieldGroup($model,'identity_address2',[]);  ?>

        <?php //echo $form->textFieldGroup($model,'identity_address3',[]);  ?>

        <?php echo $form->textFieldGroup($model, 'identity_pos_code', ['class' => 'col-md-2']); ?>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', [
            'legend' => 'Contact',
            'fieldsetHtmlOptions' => ['style' => 'padding:12px'],
        ]);
        ?>

        <div class="row">
            <div class="col-md-6">
                <?php echo $form->emailFieldGroup($model, 'email'); ?>

                <?php //echo $form->textFieldGroup($model,'email2',[]);  ?>

                <?php echo $form->textFieldGroup($model, 'home_phone'); ?>

            </div>
            <div class="col-md-6">
                <?php //echo $form->textFieldGroup($model, 'handphone', array("class" => "input-medium bfh-phone", "data-format" => "+62 ddd dddddddddd")); ?>
                <?php echo $form->textFieldGroup($model, 'handphone'); ?>

                <?php //echo $form->textFieldGroup($model, 'handphone2', []); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', [
            'legend' => 'Bank',
            'fieldsetHtmlOptions' => ['style' => 'padding:12px'],
        ]);
        ?>
        <?php echo $form->textFieldGroup($model, 'account_number', ['class' => 'col-md-2']); ?>

        <?php echo $form->textFieldGroup($model, 'account_name', ['class' => 'col-md-3']); ?>

        <?php echo $form->textFieldGroup($model, 'bank_name', []); ?>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        if ($model->scenario == 'create') {
            $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', [
                'legend' => 'Career',
                'fieldsetHtmlOptions' => ['style' => 'padding:12px'],
            ]);

            echo $this->renderPartial('_formCareerInit', ['form' => $form, 'model' => $modelCareer]);

            $this->endWidget();
        }
        ?><!-- collabsible fieldset -->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        if ($model->scenario == 'create') {
            $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', [
                'legend' => 'Status',
                'fieldsetHtmlOptions' => ['style' => 'padding:12px'],
            ]);
            echo $this->renderPartial('_formStatusInit', ['form' => $form, 'model' => $modelStatus]);

            $this->endWidget();
        }
        ?><!-- collabsible fieldset -->
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


