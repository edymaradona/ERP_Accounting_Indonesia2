<?php
$this->widget('TbGridView', [
    'id' => 'j-selection-grid',
    'dataProvider' => hApplicantSelection::model()->search($id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'name' => 'workflow_result.name',
            'header' => 'Work Flow Result'
        ],
        'workflow_by',
        'assessment_date',
        'assessment_summary',
        'development_area',
        [
            'class' => 'booster.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/jSelectionHolding/deleteAssessment",array("id"=>$data->id))',
        ],
    ],
]);
?>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker111', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'assessment_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>


<div class="row">
    <div class="col-md-7">

        <?php
        $form = $this->beginWidget('booster.widgets.TbActiveForm', [
            'id' => 'g-education-form',
            'enableAjaxValidation' => false,
            //'type'=>'horizontal',
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'assessment_date', []); ?>

        <?php echo $form->dropDownListGroup($model, 'workflow_result_id', ['widgetOptions' => [
            'data' => sParameter::items('cSelectionResult')
        ]]); ?>

        <?php echo $form->textFieldGroup($model, 'workflow_by'); ?>
        <?php echo $form->textAreaGroup($model, 'assessment_summary', ['widgetOptions' => ['htmlOptions' => ['rows' => 5]]]); ?>

        <?php echo $form->textAreaGroup($model, 'development_area', ['widgetOptions' => ['htmlOptions' => ['rows' => 5]]]); ?>

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

    </div>
</div>
