<?php
$this->breadcrumbs = [
    'Purchase Order with Dept' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/m3/m3/aPorder']],
    ['label' => 'Create Simple PO', 'url' => ['create']],
];

$this->menu1 = aPorder::getTopUpdated();
$this->menu2 = aPorder::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/cash.png') ?>
            Create New PO with Dept
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'Create PO', 'url' => Yii::app()->createUrl('create')],
        ['label' => 'Create PO With Dept', 'url' => Yii::app()->createUrl('createDept')],
        ['label' => 'Create Non PO', 'url' => Yii::app()->createUrl('create')],
    ],
]);
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', ['id' => 'aPorder-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'input_date', ["class" => "control-label"]); ?>
        <div class="controls">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', [
                'model' => $model,
                'value' => cTimestamp::formatDate('yyyy-MM-dd', $model->input_date),
                'attribute' => 'input_date',
                // additional javascript options for the date picker plugin
                'options' => [
                    'showAnim' => 'fold',
                    'dateFormat' => 'dd-mm-yy',
                ],
                'htmlOptions' => [
                ]
            ]);
            ?>
        </div>
    </div>

<?php echo $form->textFieldRow($model, 'no_ref', ['class' => 'col-md-3']); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'periode_date', ["class" => "control-label"]); ?>
        <div class="controls">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', [
                'model' => $model,
                'id' => 'balance-begin1',
                'value' => cTimestamp::formatDate('yyyy-MM-dd', $model->periode_date),
                'attribute' => 'periode_date',
                // additional javascript options for the date picker plugin
                'options' => [
                    'showAnim' => 'fold',
                    'dateFormat' => 'yymm',
                ],
                'htmlOptions' => [
                ],
            ]);
            ?>
        </div>
    </div>

<?php echo $form->dropDownListRow($model, 'budgetcomp_id', aBudget::mainComponent()); ?>


<?php echo $form->textAreaRow($model, 'remark', ['rows' => 2, 'cols' => 50]); ?>


<?php echo $form->dropDownListRow($model, 'issuer_id', sParameter::items("cIssuer")); ?>

    <div class="tabular">
        <?php
        $this->widget('ext.appendo.JAppendo', [
            'id' => 'repeateEnum',
            'model' => $model,
            'viewName' => '_detailPorderDept',
            'labelDel' => 'Remove Row'
            //'cssFile' => 'css/jquery.appendo2.css'
        ]);
        ?>
    </div>

<?php
$this->widget('zii.widgets.jui.CJuiButton', [
    'buttonType' => 'submit',
    'name' => 'btnGo7',
    'caption' => $model->isNewRecord ? 'Create' : 'Save',
    'options' => ['icons' => 'js:{secondary:"ui-icon-fa-extlink"}'],
]);
?>
<?php $this->endWidget(); ?>