<?php
$this->renderPartial('_menu');
?>

<div class="page-header">
    <h1>Address Book Group</h1>
</div>

<?php
$this->widget('TbGridView', [
    'id' => 's-addressbook-group-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        //'id',
        //'parent_id',
        [
            'name' => 'group_name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->group_name,Yii::app()->createUrl("/sSms/viewAddressbookGroup",array("id"=>$data->id)))',
        ],
        'description',
        [
            'class' => 'TbButtonColumn',
            'template' => '{update}{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("sSms/deleteAddressbookGroup",array("id"=>$data->id))',
            'updateButtonUrl' => 'Yii::app()->createUrl("sSms/updateAddressbookGroup",array("id"=>$data->id))'
        ],
        [
            'header' => 'Total Member',
            'filter' => false,
            'value' => '$data->getListMembers()->totalItemCount',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
    ],
]);
?>

