<?php
$this->breadcrumbs = [
    'User' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sUser']],
    ['label' => 'View', 'icon' => 'edit', 'url' => ['view', 'id' => $model->id]],
];

$this->menu2 = sUser::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-user fa-fw"></i>
            <?php echo $model->username; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_formNoPassword', ['model' => $model]); ?>