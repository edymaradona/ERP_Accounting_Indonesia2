<?php
/* @var $this SAddressbookGroupController */
/* @var $model sAddressbookGroup */

$this->breadcrumbs = [
    'S Addressbook Groups' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'List sAddressbookGroup', 'url' => ['index']],
    ['label' => 'Create sAddressbookGroup', 'url' => ['create']],
    ['label' => 'View sAddressbookGroup', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage sAddressbookGroup', 'url' => ['admin']],
];
?>

    <h1>Update sAddressbookGroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', ['model' => $model]); ?>