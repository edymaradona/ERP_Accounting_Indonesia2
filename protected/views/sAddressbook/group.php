<?php
/* @var $this SAddressbookGroupController */
/* @var $model sAddressbookGroup */

$this->breadcrumbs = [
    'S Addressbook Groups' => ['index'],
    'Manage',
];

$this->menu = [
    ['label' => 'Create New SMS Group', 'icon' => 'globe', 'url' => ['/sAddressbook/createGroup']],
    ['label' => 'Address Book', 'icon' => 'globe', 'url' => ['/sAddressbook']],
];

//$this->menu5=array('SMS Group');
?>

<div class="page-header">
    <h1>Address Book Group</h1>
</div>

<?php
$this->widget('TbGridView', [
    'id' => 's-addressbook-group-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        //'id',
        //'parent_id',
        'group_name',
        'description',
        [
            'class' => 'TbButtonColumn',
            'template' => '{delete}'
        ],
    ],
]);
?>
