<?php
$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 's-group-grid',
    'dataProvider' => sNotificationGroupMember::model()->search($model->id),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    //'filter'=>$model,
    'columns' => [
        [
            'class' => 'booster.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("sUser/deleteNotificationGroup",array("id"=>$data->id))',
        ],
        'parent.group_name',
        'parent.group_description',
    ],
]);
?>

<hr>
<?php
//$this->renderPartial('_formGroup', array('model'=>$modelGroup));
?>

