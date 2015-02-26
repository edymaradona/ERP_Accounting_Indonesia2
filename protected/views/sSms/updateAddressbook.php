<?php
$this->renderPartial('_menu');
?>

    <div class="page-header">
        <h1><?php echo $model->complete_name; ?></h1>
    </div>

<?php $this->renderPartial('_formAddressbook', ['model' => $model]); ?>