<?php
/* @var $this SAddressbookGroupController */
/* @var $model sAddressbookGroup */

$this->breadcrumbs = [
    'S Addressbook Groups' => ['index'],
    'Create',
];

$this->menu = [
    //array('label' => 'List sAddressbookGroup', 'url' => array('index')),
    //array('label' => 'Manage sAddressbookGroup', 'url' => array('admin')),
];
?>

    <div class="page-header">
        <h1>Create SMS Group</h1>
    </div>


<?php $this->renderPartial('_formGroup', ['model' => $model]); ?>