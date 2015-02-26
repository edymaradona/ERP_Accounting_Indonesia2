<?php
Yii::app()->getClientScript()->registerCoreScript('maskedinput');
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('dp', "
		$(function() {
		
		$( \"#" . CHtml::activeId($modelMember, 'complete_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/sSms/addressAutoComplete') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($modelMember, 'complete_name') . "\").val(ui.item.label);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($modelMember, 'pid') . "\").val(ui.item.id);
			return false;
			},
		});
				

});

		");
?>
<?php
$this->renderPartial('_menu');
?>

<div class="page-header">
    <h1><?php echo $model->group_name; ?></h1>
</div>

<?php
$this->widget('TbDetailView', [
    'data' => $model,
    'attributes' => [
        'group_name',
        'description',
        [
            'label' => 'Total Member Group',
            'value' => $model->getListMembers()->totalItemCount,
        ]
    ],
]);
?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 's-addressbook-form',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($modelMember); ?>

<?php echo $form->hiddenField($modelMember, 'pid', ['class' => 'col-md-4']); ?>
<?php echo $form->textFieldGroup($modelMember, 'complete_name', ['class' => 'col-md-4']); ?>

<div class="control-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check fa-fw"></i>Create', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>


<h4>List of Members</h4>

<?php
$this->widget('booster.widgets.TbListView', [
    'dataProvider' => $model->getListMembers(),
    'itemView' => '_viewMemberList',
]);
?>
