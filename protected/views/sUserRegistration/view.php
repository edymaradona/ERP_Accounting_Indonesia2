<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */

$this->breadcrumbs = [
    'User Registration' => ['/sUserRegistration'],
    $model->id,
];

$this->menu5 = ['User Registration'];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sUserRegistration']],
    ['label' => 'Update', 'icon' => 'pencil', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Update Password', 'icon' => 'pencil', 'url' => ['updatePassword', 'id' => $model->id]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
];
?>

<div class="page-header">
    <h1><i class="fa fa-user fa-fw"></i>
        <?php echo $model->email; ?></h1>
</div>

<?php
$this->widget('TbDetailView', [
    'data' => $model,
    'attributes' => [
        'module_name',
        'registration_date',
        'activation_code',
        'email',
        'password',
        'status.name',
    ],
]);
?>
