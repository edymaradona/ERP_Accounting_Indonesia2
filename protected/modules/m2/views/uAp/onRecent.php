<?php
$this->breadcrumbs = [
    'U Ars' => ['index'],
    'Manage',
];


$this->menu = [
    ['label' => 'AP Supplier', 'icon' => 'home', 'url' => ['/m2/uAp/apSupplier']],
];
?>


<div class="page-header">
    <h1>Account Payable: Recent</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'Unpaid. New Purchased Order', 'url' => Yii::app()->createUrl('/m2/uAp')],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uAp/onHalfPaid')],
        ['label' => 'Paid. Post to GL', 'url' => Yii::app()->createUrl('/m2/uAp/onPaid')],
        ['label' => 'Recent AP', 'url' => Yii::app()->createUrl('/m2/uAp/onRecent'), 'active' => true],
    ],
]);
?>

