<?php
Yii::app()->getClientScript()
    ->registerCoreScript('jquery.ui')
    ->registerCoreScript('maskedinput')
    ->registerScriptFile(Yii::app()->baseUrl . "/css/bootstrap-maxlength/bootstrap-maxlength.js");


Yii::app()->clientScript->registerScript('datepicker', "
	$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
		
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		'minDate'	: +1,
		});
		
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		'minDate'	: +1,
		});
		
		$( \"#" . CHtml::activeId($model, 'work_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		'minDate'	: +1,
		});
		
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'work_date') . "\" ).mask('99-99-9999');
	});

		$( \"textarea#" . CHtml::activeId($model, 'leave_reason') . "\" ).maxlength({
			alwaysShow: true
		});
		
		
		");

//$this->message = "<strong>Info Penting!</strong> Sesuai prosedur, setelah mengisi seluruh kolom inputan, simpan kemudian cetak formulir cuti  ini. Selanjutnya, ditanda tangan atasan dan diserahkan ke bagian HRD";
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-cuti-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'input_date', ['widgetOptions' => [
    'htmlOptions' => ['disabled' => true, 'value' => date("d-m-Y")]
]]); ?>


<?php echo $form->textFieldGroup($model, 'start_date', ['hint' => 'Date when your leave started']); ?>

<?php echo $form->textFieldGroup($model, 'end_date', ['hint' => 'Date when your leave ended']); ?>

<?php echo $form->numberFieldGroup($model, 'number_of_day', ['hint' => 'Total days of leaving', 'widgetOptions' => ['htmlOptions' => ['min' => 1]]]); ?>

<?php echo $form->textFieldGroup($model, 'work_date', ['hint' => 'Date when you start work again']); ?>

<?php echo $form->textAreaGroup($model, 'leave_reason', ['widgetOptions' => ['htmlOptions' => ['maxlength' => 300, 'rows' => 3]]]); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'replacement', ['class' => 'col-sm-3 control-label']); ?>
        <div class="col-sm-9">
            <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', [
                'model' => $model,
                'attribute' => 'replacement',
                'source' => $this->createUrl('/m1/gEss/personAutoComplete'),
                'options' => [
                    'minLength' => '2',
                    //'focus'=> 'js:function( event, ui ) {
                    //	$("#'.CHtml::activeId($model,'c_ganti').'").val(ui.item.label);
                    //	return false;
                    //}',
                ],
                'htmlOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Search Name',
                ],
            ]);
            ?>
        </div>
    </div>



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
<?php
$this->endWidget();
