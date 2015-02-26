<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('autocom', "
		$(function() {
		
		$( \"#" . CHtml::activeId($modelUserModule, 's_user_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('sUser/userAutoComplete') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($modelUserModule, 's_user_name') . "\").val(ui.item.label);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($modelUserModule, 's_user_id') . "\").val(ui.item.id);
			return false;
			}
			
		});
		

});

		");
?>


<?php
$this->breadcrumbs = [
    'Module' => ['index'],
    $model->title,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sModule']],
    //array('label'=>'Update', 'icon'=>'pencil','url'=>array('update','id'=>$model->id)),
];

$this->menu4 = sModule::getTopOther();
?>

<div class="page-header">
    <h1>
        <i class="fa fa-credit-card fa-fw"></i>
        <?php echo $model->title; ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-2">
        <?php
        $this->beginWidget('CTreeView', [
            'id' => 'module-tree',
            //'data'=>$items,
            'url' => ['/sModule/ajaxFillTree'],
            'collapsed' => true,
            'unique' => true,
        ]);
        $this->endWidget();
        ?>
    </div>
    <div class="col-md-10">
        <?php
        $this->widget('booster.widgets.TbDetailView', [
            //$this->widget('booster.widgets.TbEditableDetailView', array(
            'data' => $model,
            //'url' => $this->createUrl('sModule/updateAjax'), 
            'attributes' => [
                [
                    'name' => 'getparent.title',
                    'label' => 'Parent'
                ],
                'title',
                'description',
                'link',
                'image',
            ],
        ]);
        ?>

        <h3>User on this Module</h3>
        <?php
        $this->widget('booster.widgets.TbGridView', [
            'id' => 'user-module-grid',
            'dataProvider' => sUserModule::model()->searchModule($model->id),
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}',
            'columns' => [
                [
                    'name' => 's_user.username',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->s_user->username,Yii::app()->createUrl("/sUser/view",array("id"=>$data->s_user->id)))',
                ],
                [
                    'name' => 's_user.default_group',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->s_user->organization->name,Yii::app()->createUrl("/aOrganization/view",array("id"=>$data->s_user->default_group)))',
                ],
                [
                    'name' => 's_user.status_id',
                    'value' => '$data->s_user->status->name',
                ],
                [
                    'class' => 'booster.widgets.TbButtonColumn',
                    'template' => '{delete}',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("/sModule/deleteUserModule",array("id"=>$data->id))',
                ],
            ],
        ]);
        ?>

        <h3>Add New User</h3>
        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'user-module-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
        ]);
        ?>


        <?php echo $form->hiddenField($modelUserModule, 's_user_id'); ?>
        <?php echo $form->textFieldGroup($modelUserModule, 's_user_name'); ?>

        <div class="control-group">
            <?php echo CHtml::htmlButton($modelUserModule->isNewRecord ? '<i class="fa fa-check fa-fw"></i>Create' : '<i class="fa fa-check fa-fw"></i>Save', ['class' => 'btn', 'type' => 'submit']); ?>
        </div>


        <?php $this->endWidget(); ?>

    </div>
</div>
