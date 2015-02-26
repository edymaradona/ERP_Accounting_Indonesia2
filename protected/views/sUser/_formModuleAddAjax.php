<div id="form">

    <?php
    $this->widget('ext.EChosen.EChosen', [
        'target' => 'select',
    ]);
    ?>

    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 'matrix-user-module-formAdd',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'htmlOptions' => [
            'onsubmit' => "return false;", /* Disable normal form submit */
            'onkeypress' => " if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
        ],
    ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListGroup($model, 's_module_id', ['widgetOptions' => [
        'data' => sModule::itemsAll(), ['class' => 'col-md-8', 'multiple' => 'multiple']]]); ?>

    <?php
    echo CHtml::ajaxSubmitButton(
        'Submit', $this->createUrl('sUser/NewUserModuleAjax'), [
            'type' => 'POST',
            'url' => Yii::app()->createUrl('sUser/NewUserModuleAjax'),
            'data' => 'data',
            'dataType' => 'html',
            'success' => 'js:function(data) {
				$("#form").html("<div id=\'message\'></div>");  
				$("#message").html("<h2>Contact Form Submitted!</h2>")  
				.hide()  
				.fadeIn(1500, function() {  
					$("#message").append(data);  
				});  
			}',
            'error' => 'js:function(data) { // if error occured
				 //alert("Error occured.please try again");
				 alert(data);
			}',
        ]
    );
    ?>


    <?php $this->endWidget(); ?>

</div>