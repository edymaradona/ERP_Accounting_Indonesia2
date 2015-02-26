<?php
/* @var $this SNotificationGroupController */
/* @var $model sNotificationGroup */

$this->breadcrumbs = [
    'Notification Groups' => ['index'],
    'Manage',
];

$this->menu = [
    //array('label'=>'Create', 'url'=>array('create')),
];

$this->menu1 = sNotificationGroup::getTopUpdated();
$this->menu2 = sNotificationGroup::getTopCreated();
$this->menu5 = ['Notification Group'];
?>

<div class="page-header">
    <h1>
        <i class="fa fa-bars fa-fw"></i>
        Notification Group
    </h1>
</div>

<?php
$this->widget('TbGridView', [
    'id' => 's-notification-group-grid',
    'dataProvider' => $model->search(),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'name' => 'group_name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->group_name,Yii::app()->createUrl("/sNotificationGroup/view/",array("id"=>$data->id)))',
        ],
        'group_description',
        [
            'header' => 'Status',
            'name' => 'status.name',
        ],
        [
            'header' => 'Member',
            'type' => 'raw',
            'value' => '$data->userList',
        ],
        //array(
        //	'class'=>'TbButtonColumn',
        //),
    ],
]);
?>
