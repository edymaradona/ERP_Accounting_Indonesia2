<?php
/* @var $this SCompanyNewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Company News',
];

$this->menu = [
    ['label' => 'News Category', 'url' => ['/sCompanyNewsAdmin/category']],
];

$this->menu1 = sCompanyNews::getTopUpdated();
$this->menu2 = sCompanyNews::getTopCreated();
$this->menu5 = ['Company News'];
?>

<div class="page-header">
    <h1>
        <i class="fa fa-article"></i>
        Company News
    </h1>
</div>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'companynews-grid',
    'dataProvider' => $model->searchNews(),
    'filter' => $model,
    'itemsCssClass' => 'table table-striped',
    'template' => '{items}{pager}',
    'columns' => [
        [
            'name' => 'created_date',
            'value' => 'date("d-m-Y H:i",$data->created_date)',
            'filter' => false,
        ],
        [
            'name' => 'publish_date',
            'value' => 'peterFunc::nicetime(strtotime($data->publish_date))',
            'filter' => false,
        ],
        [
            'header' => 'Author',
            'name' => 'created.username',
        ],
        'category.category_name',
        [
            'name' => 'title',
            'type' => 'raw',
            'value' => 'CHtml::link($data->title,Yii::app()->createUrl("/sCompanyNewsAdmin/view",array("id"=>$data->id)))',
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{update}{delete}',
        ],
        [
            'header' => 'Priority',
            'name' => 'priority.name',
        ],
        [
            'header' => 'Approved Status',
            'name' => 'approved.name',
        ],
        [
            'name' => 'expire_date',
            'value' => 'peterFunc::nicetime(strtotime($data->expire_date))',
            'filter' => false,
        ],
    ],
]);
?>
