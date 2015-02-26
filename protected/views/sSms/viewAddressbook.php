<?php
/* @var $this SAddressbookController */
/* @var $model sAddressbook */

$this->renderPartial('_menu');
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
