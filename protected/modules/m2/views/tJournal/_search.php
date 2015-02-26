<div class="pull-right">

    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'id' => 'searchForm',
        'htmlOptions' => ['class' => 'form-inline'],
    ]);
    ?>


    <?php
    $this->widget('zii.widgets.jui.CJuiAutoComplete', [
        'model' => $model,
        'attribute' => 'system_ref',
        'source' => $this->createUrl('/m2/tJournal/journalAutoComplete'),
        'options' => [
            'minLength' => '2',
            'focus' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'system_ref') . '").val(ui.item.label);
					return false;
}',
            'select' => 'js:function( event, ui ) {
					$("#searchForm").submit();
					return false;
}',
        ],
        'htmlOptions' => [
            'class' => 'input-medium',
            'placeholder' => 'Search NoRef or Remark',
        ],
    ]);
    ?>

    <?php echo CHtml::htmlButton('<i class="icon-fa-search"></i>Search', ['class' => 'btn', 'type' => 'submit']); ?>

    <?php $this->endWidget(); ?>
</div>
