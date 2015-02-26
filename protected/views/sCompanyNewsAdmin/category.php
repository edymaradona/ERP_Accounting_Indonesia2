<?php
$this->breadcrumbs = [
    'Module' => ['index'],
    'Manage',
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/sCompanyNewsAdmin']],
];
?>

<div class="page-header">
    <h1><i class="fa fa-list"></i>
        News Category</h1>
</div>
<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'module-module-grid',
    'dataProvider' => sParameterNews::model()->search(),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => [
        //'id',
        //'parent_id',
        'sort',
        'category_name',
        'category_description',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("sCompanyNewsAdmin/deleteCategory",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'sCompanyNewsAdmin/updateCategory',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Category',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
    ],
]);
?>
<hr>

<?php echo $this->renderPartial('_formCategory', ['model' => $modelcategory]); ?>

