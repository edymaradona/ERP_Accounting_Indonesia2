<?php
$this->breadcrumbs = [
    'C Customers',
];

$this->menu = [
    //array('label' => 'Home', 'icon'=>'home', 'url' => array('/m2/uCustomer')),
];
?>

    <div class="page-header">
        <h1>
            Data Customer
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
?>