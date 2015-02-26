<?php
$this->breadcrumbs = [
    'Daddressbooks' => ['index'],
    $model->title => ['view', 'id' => $model->id],
    'Update',
];
$this->menu = [
    ['label' => 'List DAddressbook', 'url' => ['index']],
    ['label' => 'Create DAddressbook', 'url' => ['create']],
    ['label' => 'View DAddressbook', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage DAddressbook', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>
            Update DAddressbook
            <?php echo $model->id; ?>
        </h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>