<div class="pull-right">

    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', [
        'method' => 'get',
        'id' => 'searchForm',
        'action' => Yii::app()->createUrl('/m1/iLearningHolding/index2'),
        'htmlOptions' => ['class' => 'form-inline'],
    ]);
    ?>

    <?php //echo $form->textField($model,'learning_title',array('class'=>'col-md-3','maxlength'=>100)); ?>
    <?php
    $model->learning_title = null;
    $this->widget('zii.widgets.jui.CJuiAutoComplete', [
        'model' => $model,
        'attribute' => 'learning_title',
        'source' => $this->createUrl('/m1/iLearningHolding/learningAutoComplete'),
        'options' => [
            'minLength' => '2',
            'focus' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'learning_title') . '").val(ui.item.label);
					return false;
					}',
            'select' => 'js:function( event, ui ) {
					$("#searchForm").submit();
					return false;
					}',
        ],
        'htmlOptions' => [
            'class' => 'form-control col-md-6',
            'placeholder' => 'Search Learning Title',
        ],
    ]);
    ?>

    <?php echo CHtml::htmlButton('<i class="fa fa-search fa-fw"></i>Search', ['class' => 'btn', 'type' => 'submit']); ?>

    <?php $this->endWidget(); ?>

</div>

<br/>
