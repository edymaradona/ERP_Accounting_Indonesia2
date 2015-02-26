<?php
/* @var $this SAddressbookController */
/* @var $model sAddressbook */

$this->breadcrumbs = [
    'S Addressbooks' => ['index'],
    $model->title,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sAddressbook']],
];
?>

<div class="page-header">
    <h1><?php echo $model->complete_name; ?></h1>
</div>


<?php
$this->widget('TbDetailView', [
    'data' => $model,
    'attributes' => [
        //'category_name',
        'complete_name',
        'company_name',
        'title',
        'address',
        'handphone',
        'email',
        'member_of',
    ],
]);
?>
