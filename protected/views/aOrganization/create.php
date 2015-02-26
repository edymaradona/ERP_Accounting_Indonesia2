<?php
$this->breadcrumbs = [
    $model->name,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/aOrganization']],
];

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-image"></i>
            Create New Organization
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>