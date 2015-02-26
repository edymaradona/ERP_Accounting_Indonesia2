<?php
/* @var $this SAddressbookController */
/* @var $model sAddressbook */

$this->breadcrumbs = [
    'S Addressbooks' => ['index'],
    'Manage',
];

$this->menu = [
    ['label' => 'Address Book Group', 'icon' => 'home', 'url' => ['/sAddressbook/group']],
];
$this->menu5 = ['Contact'];
?>

<div class="page-header">
    <h1>Address Book</h1>
</div>

<?php
$this->widget('TbGridView', [
    'id' => 's-addressbook-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        //'category_name',
        [
            'name' => 'complete_name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->complete_name,Yii::app()->createUrl("/sAddressbook/view",array("id"=>$data->id)))',
        ],
        'company_name',
        'title',
        //'address',
        'handphone',
        'email',
        //array(
        //	'class'=>'TbButtonColumn',
        //),
    ],
]);
?>
