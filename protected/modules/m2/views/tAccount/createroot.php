<?php
$this->breadcrumbs = [
    'Chart of Accounts' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/tAccount']],
];

$this->menu1 = tAccount::getTopUpdated();
$this->menu2 = tAccount::getTopCreated();
?>

    <div class="page-header">
        <h1>
            Create New Root Account
        </h1>
    </div>

<?php echo $this->renderPartial('_formroot', ['model' => $model]); ?>