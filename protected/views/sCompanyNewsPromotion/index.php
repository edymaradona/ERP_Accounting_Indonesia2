<?php
/* @var $this SCompanyNewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Company News',
];

$this->menu = [
    //['label' => 'News Category', 'url' => ['/sCompanyNewsAdmin/category']],
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
    'dataProvider' => $model->searchNewsPromotion(),
    'filter' => $model,
    'itemsCssClass' => 'table table-striped',
    'template' => '{items}{pager}',
    'columns' => [
        [
            'header' => 'Created / Publish / Expire Date',
            'filter' => false,
            'type' => 'raw',
            'value' => function ($data) {
                    return date("d-m-Y H:i",$data->created_date) . " <br/>" .
                    peterFunc::nicetime(strtotime($data->publish_date)) . " <br/>" . peterFunc::nicetime(strtotime($data->expire_date));
                },
        ],
        [
            'header' => 'Category / Author / Company',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->category->category_name ."<br/>".
                    $data->created->username . " <br/> " . $data->created->organization->name;
                },
        ],
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
            'header' => 'Status / Priority',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->approved->name . " <br/>" . $data->priority->name;
                },
        ],
    ],
]);
?>
