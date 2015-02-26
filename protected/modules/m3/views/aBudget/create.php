<?php
$this->breadcrumbs = [
    'Abudgets' => ['index'],
    'Create',
];
$this->menu = [
    ['label' => 'List aBudget', 'url' => ['index']],
    ['label' => 'Manage aBudget', 'url' => ['admin']],
];
?>
    <div class="page-header">
        <h1>
            <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/balance.png') ?>
            Create aBudget
        </h1>
    </div>
<?php echo $this->renderPartial('_form', ['model' => $model]); ?>