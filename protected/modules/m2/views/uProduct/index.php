<?php
$this->breadcrumbs = [
    'X Products',
];

$this->menu = [
    ['label' => 'Create xProduct', 'url' => ['create']],
    ['label' => 'Manage xProduct', 'url' => ['admin']],
];
?>

<h1>X Products</h1>

<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
?>
