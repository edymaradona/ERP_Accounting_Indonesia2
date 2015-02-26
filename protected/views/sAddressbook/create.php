<?php
/* @var $this SAddressbookController */
/* @var $model sAddressbook */

$this->breadcrumbs = [
    'S Addressbooks' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'List sAddressbook', 'url' => ['index']],
    ['label' => 'Manage sAddressbook', 'url' => ['admin']],
];
?>

    <div class="page-header">
        <h1>Create New Contact</h1>
    </div>

<?php $this->renderPartial('_form', ['model' => $model]); ?>