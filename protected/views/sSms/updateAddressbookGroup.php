<?php
/* @var $this SAddressbookGroupController */
/* @var $model sAddressbookGroup */

$this->renderPartial('_menu');
?>

    <div class="page-header">
        <h1>Update: <?php echo $model->group_name; ?></h1>
    </div>

<?php $this->renderPartial('_formAddressbookGroup', ['model' => $model]); ?>