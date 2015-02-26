<?php
/* @var $this SAddressbookController */
/* @var $model sAddressbook */

$this->breadcrumbs = [
    'S Addressbooks' => ['index'],
    $model->title => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'List sAddressbook', 'url' => ['index']],
    ['label' => 'Create sAddressbook', 'url' => ['create']],
    ['label' => 'View sAddressbook', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage sAddressbook', 'url' => ['admin']],
];
?>

    <h1>Update sAddressbook <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', ['model' => $model]); ?>