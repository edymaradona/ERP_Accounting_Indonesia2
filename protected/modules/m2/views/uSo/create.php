<?php
$this->breadcrumbs = [
    'U Sos' => ['index'],
    'Create',
];


$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/uSo']],
];


$this->menu1 = uSo::getTopUpdated();
$this->menu2 = uSo::getTopCreated();
?>


    <div class="page-header">
        <h1>Create</h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>