<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = [
    'Inter Office Memo' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/yIom']],
];

$this->menu1 = yIom::getTopUpdated();
$this->menu2 = yIom::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-article"></i>
            Create
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>