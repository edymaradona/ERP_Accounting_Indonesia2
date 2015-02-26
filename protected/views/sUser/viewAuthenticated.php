<?php
$this->breadcrumbs = [
    $model->username,
];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-user fa-fw"></i>
            <?php echo CHtml::encode($model->username); ?>
        </h1>
    </div>

<?php echo $this->renderPartial('_userDetail', ['model' => $model]); ?>