<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'scompany-news-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => true,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'title'); ?>

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
                    'class' => 'form-control'
                ]
            ]
        );
        ?>
    </div>
</div>

<?php
echo $form->redactorGroup($model, 'content', [], ['class' => 'col-md-4', 'rows' => 15]);
?>

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


<?php $this->endWidget(); ?>
