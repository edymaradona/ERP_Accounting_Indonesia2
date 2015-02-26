<?php
$this->breadcrumbs = [
    'U Ars' => ['index'],
    'Manage',
];


$this->menu = [
    ['label' => 'AR Customer', 'icon' => 'home', 'url' => ['/m2/uAr/arCustomer']],
];
?>


<div class="page-header">
    <h1>Account Receivable: Recent</h1>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'Unpaid. New Sales Order', 'url' => Yii::app()->createUrl('/m2/uAr')],
        ['label' => 'Half Paid', 'url' => Yii::app()->createUrl('/m2/uAr/onHalfPaid')],
        ['label' => 'Paid. Post to GL', 'url' => Yii::app()->createUrl('/m2/uAr/onPaid')],
        ['label' => 'Recent AR', 'url' => Yii::app()->createUrl('/m2/uAr/onRecent'), 'active' => true],
    ],
]);
?>

