<div id="form">

    <?php
    $this->widget('ext.EChosen.EChosen', [
        'target' => 'select',
    ]);
    ?>

    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 'matrix-user-module-formAdd',
        //'type'=>'horizontal',
        'enableAjaxValidation' => false,
    ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownList($model, 's_module_id', sModule::itemsAll(),
        ['class' => 'form-control col-md-12', 'multiple' => 'multiple']); ?>
    <?php /*
    $this->widget(
        'booster.widgets.TbSelect2',
        [
            'asDropDownList' => false,
            'model' => $model,
            'attribute'=>'s_module_id',
            'options' => [
                //'tags' => sModule::itemsAll(),
                'tags' => array('1'=>'clever', '2'=>'is', '3'=>'better', '4'=>'clevertech'),
                //'placeholder' => 'type clever, or is, or just type!',
                'width' => '100%',
                'tokenSeparators' => [',', ' ']
            ]
        ]
    );
     */
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

</div>