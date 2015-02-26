<?php
$this->breadcrumbs = [
    $model->name,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/aOrganization']],
    ['label' => 'View', 'icon' => 'pencil', 'url' => ['view', 'id' => $model->id]],
];

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
$this->menu3 = aOrganization::getTopRelated($model->id);
$this->menu5 = ['Organization'];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-image"></i>
            Update:
            <?php echo $model->name; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>