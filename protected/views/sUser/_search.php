<div class="row">
    <div class="col-sm-12">
        <?php

        $form = $this->beginWidget('booster.widgets.TbActiveForm', [
            //'action'=>Yii::app()->createUrl($this->route),
            //'action'=>Yii::app()->createUrl('/m1/gPerson/view',array("id"=> *_PARAMETER_*),
            'action' => Yii::app()->createUrl('/sUser/index'),
            'method' => 'get',
            'id' => 'searchForm',
            'htmlOptions' => ['class' => 'form-inline'],
        ]);
        ?>

        <?php //echo $form->textField($model,'employee_name',array('class'=>'col-md-3','maxlength'=>100)); ?>
        <?php

        $this->widget('zii.widgets.jui.CJuiAutoComplete', [
            'model' => $model,
            'attribute' => 'username',
            'source' => $this->createUrl('/sUser/userAutoComplete'),
            'options' => [
                'minLength' => '2',
                'focus' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'username') . '").val(ui.item.label);
					return false;
					}',
                'select' => 'js:function( event, ui ) {
					$("#searchForm").submit();
					return false;
					}',
            ],
            'htmlOptions' => [
                'class' => 'form-control col-md-5',
                'placeholder' => 'Search Name or Company Name',
            ],
        ]);
        ?>

        <?php //echo CHtml::htmlButton('<i class="fa fa-search fa-fw"></i>Search', array('class'=>'btn','type'=>'submit')); ?>

        <?php $this->endWidget(); ?>
    </div>
</div>
