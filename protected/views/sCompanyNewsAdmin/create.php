<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = [
    'Company News' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/sCompanyNewsAdmin']],
];

$this->menu1 = sCompanyNews::getTopUpdated();
$this->menu2 = sCompanyNews::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-article"></i>
            Create
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>