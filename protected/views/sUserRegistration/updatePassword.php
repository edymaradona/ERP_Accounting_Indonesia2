<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */

$this->breadcrumbs = [
    'User Registration' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu5 = ['User Registration'];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sUserRegistration']],
    ['label' => 'View', 'icon' => 'edit', 'url' => ['view', 'id' => $model->id]],
];
?>

    <div class="page-header">
        <h1><i class="fa fa-user fa-fw"></i>Update Password:  <?php echo $model->email; ?></h1>
    </div>
<?php echo $this->renderPartial('_formPassword', ['model' => $model]); ?>