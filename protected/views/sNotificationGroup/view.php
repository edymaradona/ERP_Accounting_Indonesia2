<?php
/* @var $this SNotificationGroupController */
/* @var $model sNotificationGroup */

$this->breadcrumbs = [
    'S Notification Groups' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/sNotificationGroup']],
    ['label' => 'Update', 'url' => ['update', 'id' => $model->id]],
];

$this->menu1 = sNotificationGroup::getTopUpdated();
$this->menu2 = sNotificationGroup::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-bars fa-fw"></i>
            Notification Group
        </h1>
    </div>


<?php
$this->widget('TbDetailView', [
    'data' => $model,
    'attributes' => [
        'group_name',
        'group_description',
        [
            'label' => 'Status',
            'name' => 'status.name',
        ],
    ],
]);
?>

<?php
$this->widget('TbGridView', [
    'id' => 's-notification-group-member-grid',
    'dataProvider' => sNotificationGroupMember::model()->searchParent($model->id),
    'template' => '{items}',
    'columns' => [
        [
            'header' => 'User Name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->user->username,Yii::app()->createUrl("/sUser/view",array("id"=>$data->user->id)))',
        ],
        [
            'header' => 'Default Group',
            'value' => '$data->user->organization->name',
        ],
        'status_id',
        [
            'class' => 'TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/sNotificationGroup/deleteNotificationGroupMember",array("id"=>$data->id))',
        ],
    ],
]);
?>

    <h3>New Notification Group Member</h3>

<?php echo $this->renderPartial('_formNotificationGroupMember', ['model' => $modelNotificationGroupMember]); ?>