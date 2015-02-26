<?php
$this->breadcrumbs = [
    'Cash and Bank' => ['/m2/uCashbank'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/uCashbank']],
];

$this->menu1 = tJournal::getTopUpdated(2);
$this->menu2 = tJournal::getTopCreated(2);
?>


    <div class="page-header">
        <h1>
            Cash and Bank: Expense
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'Expense', 'url' => Yii::app()->createUrl('/m2/uCashbank/create'), 'active' => true],
        ['label' => 'Income', 'url' => Yii::app()->createUrl('/m2/uCashbank/createIncome')],
    ],
]);

echo $this->renderPartial('_tabCreateExpense', ['model' => $model]);
