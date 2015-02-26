<?php
if ($model->structure_id == 3) {
    $this->breadcrumbs = [
        $model->getparent->getparent->name => ['view', 'id' => $model->getparent->getparent->id],
        $model->getparent->name => ['view', 'id' => $model->getparent->id],
        $model->name,
    ];
} elseif ($model->structure_id == 2) {
    $this->breadcrumbs = [
        $model->getparent->name => ['view', 'id' => $model->getparent->id],
        $model->name,
    ];
} else {
    $this->breadcrumbs = [
        $model->name,
    ];
}

$this->menu = [
    ['label' => 'Home', 'url' => ['/m3/aOrganization']],
    ['label' => 'Create', 'url' => ['create']],
    ['label' => 'View', 'url' => ['view', 'id' => $model->id]],
];

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
$this->menu3 = aOrganization::getTopRelated($model->id);
?>

    <div class="page-header">
        <h1>
            Update:
            <?php echo $model->name; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>