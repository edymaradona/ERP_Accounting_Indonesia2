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
];

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
?>

    <div class="page-header">
        <h1>Create New Organization</h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>