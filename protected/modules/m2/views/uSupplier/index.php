<?php
$this->breadcrumbs = [
    'C Suppliers',
];

$this->menu = [
    //array('label' => 'Home', 'icon'=>'home', 'url' => array('/m2/uSupplier')),
];
?>

    <div class="page-header">
        <h1>
            Data Supplier
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
?>