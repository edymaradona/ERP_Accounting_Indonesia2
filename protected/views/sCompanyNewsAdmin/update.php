<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = [
    'Company News' => ['index'],
    $model->title => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sCompanyNewsAdmin']],
    ['label' => 'View', 'icon' => 'edit', 'url' => ['/sCompanyNewsAdmin/view', "id" => $model->id]],
];

$this->menu1 = sCompanyNews::getTopUpdated();
$this->menu2 = sCompanyNews::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-article"></i>
            Update
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>