<?php
$this->breadcrumbs = [
    'Organization Structure',
];

$this->menu = [
    ['label' => 'Create', 'url' => ['create']],
];

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
?>

<div class="pull-right">
    <?php
    $this->renderPartial('_search', [
        'model' => $model,
    ]);
    ?>
</div>

<div class="page-header">
    <h1>
        <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/document_organization_chart_01.png') ?>
        Organization Structure
    </h1>
</div>


<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]);
?>
