<?php
if (isset($model->getparent->getparent->getparent->account_name)) {
    $this->breadcrumbs = [
        $model->getparent->getparent->getparent->account_name => ['view', 'id' => $model->getparent->getparent->getparent->id],
        $model->getparent->getparent->account_name => ['view', 'id' => $model->getparent->getparent->id],
        $model->getparent->account_name => ['view', 'id' => $model->getparent->id],
        $model->account_name,
    ];
} elseif (isset($model->getparent->getparent->account_name)) {
    $this->breadcrumbs = [
        $model->getparent->getparent->account_name => ['view', 'id' => $model->getparent->getparent->id],
        $model->getparent->account_name => ['view', 'id' => $model->getparent->id],
        $model->account_name,
    ];
} elseif (isset($model->getparent->account_name)) {
    $this->breadcrumbs = [
        $model->getparent->account_name => ['view', 'id' => $model->getparent->id],
        $model->account_name,
    ];
} else {
    $this->breadcrumbs = [
        $model->account_name,
    ];
}


$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/tAccount']],
    //array('label'=>'Create', 'url'=>array('create')),
    ['label' => 'View', 'icon' => 'zoom-in', 'url' => ['view', 'id' => $model->id]],
];

$this->menu1 = tAccount::getTopUpdated();
$this->menu2 = tAccount::getTopCreated();
$this->menu3 = tAccount::getTopRelated($model->account_name);
$this->menu5 = ['Account'];
?>

    <div class="page-header">
        <h1>
            Update:
            <?php echo $model->account_no . ". " . $model->account_name; ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_formupdate', ['model' => $model]); ?>