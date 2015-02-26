<?php

$this->breadcrumbs = [
    'Cash and Bank' => ['/m2/uCashbank'],
    'Update',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/uCashbank']],
];

$this->menu1 = tJournal::getTopUpdated(2);
$this->menu2 = tJournal::getTopCreated(2);
?>


<?php

if ($model->journal_type_id == null) {
    $this->widget('bootstrap.widgets.TbTabs', [
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => [
            ['label' => 'Expense', 'content' => $this->renderPartial("_tabCreateExpense", ["model" => $model], true), 'active' => true],
            ['label' => 'Income', 'content' => $this->renderPartial("_tabCreateIncome", ["model" => $model], true)],
        ],
    ]);
} elseif ($model->journal_type_id == 2) {
    $this->renderPartial("_tabCreateIncome", ["model" => $model]);
} else {
    $this->renderPartial("_tabCreateExpense", ["model" => $model]);
}
?>
