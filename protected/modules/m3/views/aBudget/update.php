<?php
$this->breadcrumbs = [
    'Abudgets' => ['index'],
    $model->name => ['view', 'id' => $model->id],
    'Update',
];
$this->menu = [
    ['label' => 'List aBudget', 'url' => ['index']],
    ['label' => 'Create aBudget', 'url' => ['create']],
    ['label' => 'View aBudget', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage aBudget', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>
            <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/balance.png') ?>
            Update aBudget
            <?php echo $model->id; ?>
        </h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>