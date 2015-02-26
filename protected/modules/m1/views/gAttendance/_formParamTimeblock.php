<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'g-param-timeblock-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>


<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'code', ['size' => 25, 'maxlength' => 25]); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'in', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-3 ">
        <?php
        $this->widget(
            'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                'model' => $model,
                'attribute' => 'in',
                'options' => [
                    'timeOnly' => true,
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
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
    <?php echo $form->labelEx($model, 'out', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-9 ">
        <?php
        $this->widget(
            'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                'model' => $model,
                'attribute' => 'out',
                'options' => [
                    'timeOnly' => true,
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
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
    <?php echo $form->labelEx($model, 'rest_in', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-9">
        <?php
        $this->widget(
            'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                'model' => $model,
                'attribute' => 'rest_in',
                'options' => [
                    'timeOnly' => true,
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
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
    <?php echo $form->labelEx($model, 'rest_out', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-9">
        <?php
        $this->widget(
            'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                'model' => $model,
                'attribute' => 'rest_out',
                'options' => [
                    'timeOnly' => true,
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                ],
                'htmlOptions' => [
                    'class' => 'form-control'
                ]
            ]
        );
        ?>
    </div>
</div>
<?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>

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
