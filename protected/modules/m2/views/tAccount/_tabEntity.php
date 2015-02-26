<h3>Entity List</h3>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 't-account-entity-grid',
    'dataProvider' => tAccountEntity::model()->searchAccount($model->id),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => [
        [
            'class' => 'booster.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m2/tAccount/deleteEntity",array("id"=>$data->id))',
        ],
        [
            'name' => 'entity_id',
            'type' => 'raw',
            'value' => 'CHtml::link($data->entity->name,Yii::app()->createUrl("/aOrganization/view",array("id"=>$data->entity->id)))',
        ],
        [
            'name' => 'state_id',
            'value' => 'sParameter::item("cStatusAcc",$data->state_id)',
        ],
        'remark',
    ],
]);
?>

<h3>New Entity</h3>
<?php echo $this->renderPartial('_formEntity', ['model' => $modelEntity]); ?>