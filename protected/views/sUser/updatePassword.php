<?php
$this->breadcrumbs = [
    'User' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];


$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sUser']],
    ['label' => 'View Self', 'icon' => 'edit', 'url' => ['viewSelf', 'id' => $model->id]],
];

//$this->menu2=sUser::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-user fa-fw"></i>
            <?php echo $model->username; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_formPassword', ['model' => $model]); ?>