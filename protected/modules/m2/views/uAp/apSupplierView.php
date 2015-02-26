<?php
$this->breadcrumbs = [
    'C Suppliers' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'AP Dashboard', 'icon' => 'home', 'url' => ['/m2/uAp']],
    ['label' => 'AP Supplier', 'icon' => 'home', 'url' => ['/m2/uAp/apSupplier']],
];
?>

<div class="page-header">
    <h1>
        <?php echo $model->company_name; ?>
    </h1>
</div>


<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => [
        ['label' => 'Sales Order List', 'content' => $this->renderPartial("_apSupplierDetail", ["model" => $model], true), 'active' => true],
        ['label' => 'Detail', 'content' => $this->renderPartial("/uSupplier/_detail", ["model" => $model], true)],
    ],
]);
?>

