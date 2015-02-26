<?php
/* @var $this SCompanyNewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Company News',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/site/login']],
];

$this->menu1 = sCompanyNews::getTopUpdated();
$this->menu2 = sCompanyNews::getTopCreated();
//$this->menu5=array('Company News');
?>

<div class="row">
    <div class="col-md-8">
        <div class="page-header">
            <h1>
                <i class="fa fa-article"></i>
                Company News
            </h1>
        </div>

        <?php
        $this->renderPartial('_search', [
            'model' => $model,
        ]);
        ?>

        <?php
        $this->widget('zii.widgets.CListView', [
            'dataProvider' => $dataProvider,
            'template' => '{pager}{items}{pager}',
            'itemView' => '_view',
        ]);
        ?>

    </div>
    <div class="col-md-4">

        <?php
        $this->widget('ext.albumPhoto', ['dir' => Yii::app()->basePath . "/../shareimages/photo/",
            'columns' => 6,
            'span' => 6,
            'limit' => 4,
            'header' => 5,
            'showDescription' => false,
        ]);
        ?>

        <?php $this->renderPartial("/site/_category", ['category_id' => 1]) ?>
        <?php $this->renderPartial("/site/_category", ['category_id' => 2]) ?>
        <?php $this->renderPartial("/site/_category", ['category_id' => 3]) ?>
    </div>
</div>

