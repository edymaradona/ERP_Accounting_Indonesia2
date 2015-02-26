<?php
$this->breadcrumbs = [
    'C Customers' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'AR Dashboard', 'icon' => 'home', 'url' => ['/m2/uAr']],
    ['label' => 'AR Customer', 'icon' => 'home', 'url' => ['/m2/uAr/arCustomer']],
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
        ['label' => 'Sales Order List', 'content' => $this->renderPartial("_arCustomerDetail", ["model" => $model], true), 'active' => true],
        ['label' => 'Detail', 'content' => $this->renderPartial("/uCustomer/_detail", ["model" => $model], true)],
    ],
]);
?>

