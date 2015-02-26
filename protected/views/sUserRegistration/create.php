<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */

$this->breadcrumbs = [
    'S User Registrations' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sUserRegistration']],
];
?>

    <div class="page-header">
        <h1><i class="fa fa-user fa-fw"></i>Create</h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>