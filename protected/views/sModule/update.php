<?php
$this->breadcrumbs = [
    'Module' => ['index'],
    $model->name => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sModule']],
    ['label' => 'View', 'icon' => 'edit', 'url' => ['view', 'id' => $model->id]],
];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-credit-card fa-fw"></i>
            <?php echo $model->title; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>