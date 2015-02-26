<h3>Rights</h3>
<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'mat-user-module-grid1',
    'dataProvider' => sUser::model()->userRight($model->id),
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'template' => '{items}{pager}',
    'columns' => [
        [
            'header' => 'Roles',
            'name' => 'itemname',
        ],
    ]
]);
?>

<h3>Modules</h3>
<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'mat-user-module-grid',
    'dataProvider' => sUserModule::model()->searchUser($model->id),
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'template' => '{items}{pager}',
    'columns' => [
        [
            'class' => 'booster.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("sUser/deleteModule",array("id"=>$data->id))',
        ],
        [
            'name' => 's_module_id',
            'type' => 'raw',
            'value' => '($data->s_module->parent_id == 0) ?
						CHtml::link($data->s_module->title,Yii::app()->createUrl("/sModule/view",array("id"=>$data->s_module->id))) :
						CHtml::link("--- ".$data->s_module->title,Yii::app()->createUrl("/sModule/view",array("id"=>$data->s_module->id)))',
        ],
        //'s_module.description',
    ],
]);
?>
<hr>
<?php
$this->renderPartial('_formModuleAdd', ['model' => $modelModule, 'modelParent' => $model]);
?>
