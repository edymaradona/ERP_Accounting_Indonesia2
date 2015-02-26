<?php
/* @var $this SNotificationGroupController */
/* @var $model sNotificationGroup */

$this->breadcrumbs = [
    'S Notification Groups' => ['index'],
    'Create',
];

$this->menu = [
    //array('label' => 'List sNotificationGroup', 'url' => array('index')),
    //array('label' => 'Manage sNotificationGroup', 'url' => array('admin')),
];

$this->menu1 = sNotificationGroup::getTopUpdated();
$this->menu2 = sNotificationGroup::getTopCreated();
?>

    <div class="page-header">
        <h1><i class="fa fa-bars fa-fw"></i>Create New Notification Group</h1>
    </div>


<?php echo $this->renderPartial('_form', ['model' => $model]); ?>