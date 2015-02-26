<?php
$this->breadcrumbs = [
    'User' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sUser']],
];

$this->menu2 = sUser::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-user fa-fw"></i>
            <?php echo "Create New User"; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>