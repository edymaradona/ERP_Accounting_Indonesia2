<?php
/* @var $this SAddressbookGroupController */
/* @var $model sAddressbookGroup */

$this->breadcrumbs = [
    'S Addressbook Groups' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Address Book', 'url' => ['/sAddressbook']],
    ['label' => 'Address Book Group', 'url' => ['/sAddressbook/group']],
];
?>

<div class="page-header">
    <h1><?php echo $model->group_name; ?></h1>
</div>

<?php
$this->widget('TbDetailView', [
    'data' => $model,
    'attributes' => [
        'group_name',
        'description',
    ],
]);
?>
