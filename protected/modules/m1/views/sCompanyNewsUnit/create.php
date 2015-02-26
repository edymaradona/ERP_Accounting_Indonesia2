<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = [
    'Company News' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/sCompanyNewsUnit']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

//$this->menu1 = sCompanyNews::getTopUpdated();
//$this->menu2 = sCompanyNews::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-article"></i>
            Create
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>