<?php
/* @var $this SNotificationGroupController */
/* @var $model sNotificationGroup */

$this->breadcrumbs = [
    'S Notification Groups' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'List sNotificationGroup', 'url' => ['index']],
    ['label' => 'Create sNotificationGroup', 'url' => ['create']],
    ['label' => 'View sNotificationGroup', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage sNotificationGroup', 'url' => ['admin']],
];
?>

    <h1>
        <i class="fa fa-bars fa-fw"></i>
        Update sNotificationGroup <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>