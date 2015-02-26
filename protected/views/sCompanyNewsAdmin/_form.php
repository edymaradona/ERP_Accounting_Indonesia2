<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'sNotification-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'title', ['class' => 'col-md-7']); ?>

<?php echo $form->dropDownListGroup($model, 'category_id', ['widgetOptions' => [
    'data' => sParameterNews::items()
]]); ?>

<?php echo $form->dropDownListGroup($model, 'priority_id', ['widgetOptions' => [
    'data' => sParameter::items('cPriority')
]]); ?>

<?php echo $form->textFieldGroup($model, 'tags', ['class' => 'col-md-3']); ?>

<?php echo $form->dropDownListGroup($model, 'approved_id', ['widgetOptions' => [
    'data' => sParameter::items('cStatusP')
]]); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'publish_date', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-9">
        <?php
        $this->widget(
            'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                'model' => $model,
                'attribute' => 'publish_date',
                'options' => [
                    'dateFormat' => 'dd-mm-yy',
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                    //'defaultValue' => (isset($model->publish_date)) ? date('d-m-Y',strtotime($model->publish_date)) : date('d-m-Y h:i'),
                ],
                'htmlOptions' => [
                    //'value'=>(isset($model->publish_date)) ? date('d-m-Y',strtotime($model->publish_date)) : date('d-m-Y h:i'),
                    'class' => 'form-control'
                ]
            ]
        );
        ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'expire_date', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-9">
        <?php
        $this->widget(
            'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                'model' => $model,
                'attribute' => 'expire_date',
                'options' => [
                    'dateFormat' => 'dd-mm-yy',
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                    'defaultValue' => (isset($model->expire_date)) ? date('d-m-Y h:i', strtotime($model->expire_date)) : date('d-m-Y h:i'),
                ],
                'htmlOptions' => [
                    'hint' => 'When empty, it mean unlimited',
                    'class' => 'form-control'
                ],
            ]
        );
        ?>
    </div>
</div>

<?php
//echo $form->html5EditorRow($model, 'content', array(
//    'class' => 'col-md-4', 'rows' => 25, 'height' => '300', 'options' => array('color' => true)));
echo $form->redactorGroup($model, 'content', [], ['class' => 'col-md-4', 'rows' => 15]);
?>

<div class="control-group">
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        // 'type' => 'primary',
        'icon' => 'fa fa-check',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ]);
    ?>
</div>


<?php $this->endWidget(); ?>
