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

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'employee_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/m1/iLearning/personAutoCompletePhoto') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'employee_name') . "\").val(ui.item.label);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'employee_id') . "\").val(ui.item.id);
			return false;
			},
			
		})
		.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\")
			.data( \"item.autocomplete\", item )
			.append('<a class=\'userautocompletelink\'><img src=\'"
    . Yii::app()->baseUrl . "/shareimages/hr/employee/thumb/" . "'+item.photo+'\'/><strong>'+item.label+'</strong><br/>'+item.company+'</a>')
			.appendTo( ul );
		};
		

});

		");

Yii::app()->clientScript->registerScript('something', '$("#' . CHtml::activeId($model, 'employee_name') . '").focus();');
?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'i-learning-sch-part-form',
    'enableAjaxValidation' => false,
    'type' => 'inline',
    'htmlOptions' => [
        'onsubmit' => "return false;", /* Disable normal form submit */
        //'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
    ],
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'employee_name', ['wrapperHtmlOptions' => [
    'class' => 'col-sm-8',
]]); ?>
<?php echo $form->hiddenField($model, 'employee_id'); ?>

<?php
$this->widget('booster.widgets.TbButton', [
    'buttonType' => 'submit',
    'context' => 'primary',
    'icon' => 'fa fa-check',
    'label' => $model->isNewRecord ? 'Create' : 'Save',
    'htmlOptions' => [
        'onclick' => 'send();'
    ]
]);
?>


<?php
$this->endWidget();
?>


<script type="text/javascript">

    function send() {
        var data = $("#i-learning-sch-part-form").serialize();

        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("m1/iLearning/createParticipantAjax",["id"=> $id ]); ?>',
            data: data,
            success: function (data) {
                $.fn.yiiGridView.update("i-learning-sch-part-grid", {
                    data: $("i-learning-sch-part-grid").serialize()
                });
            },

            error: function (data) { // if error occured
                alert("Error occured.please try again");
                alert(data);
            },

            dataType: 'html'
        });

    }

</script>
