<?php
$this->breadcrumbs = [
    'U Pos' => ['index'],
    'Create',
];


$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/uPo']],
];


$this->menu1 = uPo::getTopUpdated();
$this->menu2 = uPo::getTopCreated();
?>


    <div class="page-header">
        <h1>Create</h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>