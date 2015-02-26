<?php
$this->breadcrumbs = [
    'Module' => ['index'],
    'Manage',
];


$this->menu = [
    //array('label'=>'Create', 'url'=>array('create')),
];

$this->menu4 = sModule::getTopOther();
?>

<div class="page-header">
    <h1><i class="fa fa-credit-card"></i>
        Data Module</h1>
</div>

<div class="row">
    <div class="col-md-3">
        <?php
        $this->beginWidget('CTreeView', [
            'id' => 'module-tree',
            //'data'=>$items,
            'url' => ['/sModule/ajaxFillTree'],
            'collapsed' => true,
            'unique' => true,
        ]);
        $this->endWidget();
        ?>
    </div>
    <div class="col-md-9">

        <?php
        $this->widget('booster.widgets.TbGridView', [
            'id' => 'module-module-grid',
            'dataProvider' => $model->search(),
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}',
            'columns' => [
                [
                    'class' => 'EJuiDlgsColumn',
                    'template' => '{update}{delete}',
                    //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("sModule/delete",array("id"=>$data->id))',
                    'updateDialog' => [
                        'controllerRoute' => 'sModule/update',
                        'actionParams' => ['id' => '$data->id'],
                        'dialogTitle' => 'Update Module',
                        'dialogWidth' => 512, //override the value from the dialog config
                        'dialogHeight' => 530
                    ],
                ],
                'id',
                [
                    'header' => 'Application',
                    'name' => 'getparent.title',
                ],
                [
                    'name' => 'name',
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'sort',
                    'sortable' => false,
                    'editable' => [
                        'url' => $this->createUrl('/sModule/updateAjax'),
                        //'placement' => 'right',
                        'inputclass' => 'col-md-1'
                    ]],
                [
                    'name' => 'title',
                    'type' => 'raw',
                    'value' => 'CHtml::link(($data->parent_id == 0) ? $data->title : "--- ".$data->title,Yii::app()->createUrl("/sModule/view",array("id"=>$data->id)))'
                ],
                [
                    'name' => 'link',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->link,Yii::app()->createUrl($data->link))'
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'image',
                    'sortable' => false,
                    'editable' => [
                        'url' => $this->createUrl('/sModule/updateAjax'),
                        //'placement' => 'right',
                        'inputclass' => 'col-md-1'
                    ]],
            ],
        ]);
        ?>
        <hr>

        <?php echo $this->renderPartial('_form', ['model' => $modelmodule]); ?>

    </div>
</div>
