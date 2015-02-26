<?php
if (isset($model->getparent->getparent->getparent->getparent->name)) {
    $this->breadcrumbs = [
        $model->getparent->getparent->getparent->getparent->name => ['view', 'id' => $model->getparent->getparent->getparent->id],
        $model->getparent->getparent->getparent->name => ['view', 'id' => $model->getparent->getparent->id],
        $model->getparent->getparent->name => ['view', 'id' => $model->getparent->id],
        $model->getparent->name => ['view', 'id' => $model->getparent->id],
        $model->name,
    ];
} elseif (isset($model->getparent->getparent->getparent->name)) {
    $this->breadcrumbs = [
        $model->getparent->getparent->getparent->name => ['view', 'id' => $model->getparent->getparent->getparent->id],
        $model->getparent->getparent->name => ['view', 'id' => $model->getparent->getparent->id],
        $model->getparent->name => ['view', 'id' => $model->getparent->id],
        $model->name,
    ];
} elseif (isset($model->getparent->getparent->name)) {
    $this->breadcrumbs = [
        $model->getparent->getparent->name => ['view', 'id' => $model->getparent->getparent->id],
        $model->getparent->name => ['view', 'id' => $model->getparent->id],
        $model->name,
    ];
} elseif (isset($model->getparent->name)) {
    $this->breadcrumbs = [
        $model->getparent->name => ['view', 'id' => $model->getparent->id],
        $model->name,
    ];
} else {
    $this->breadcrumbs = [
        $model->name,
    ];
}

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/aOrganization']],
    //array('label'=>'Create Root', 'url'=>array('create')),
    ['label' => 'Update', 'icon' => 'edit', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
];

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
$this->menu3 = aOrganization::getTopRelated($model->id);
$this->menu5 = ['Organization'];
?>

<div class="page-header">
    <h1>
        <i class="fa fa-image"></i>

        <div style="width:50px; float:left; margin-right:10px">
        </div>
        <?php
        echo $model->name;
        echo($model->topStatus);
        ?>
    </h1>
</div>


<div class="row">
    <div class="col-md-3">

        <h5>All Tree</h5>

        <?php
        $this->beginWidget('CTreeView', [
            'id' => 'module-tree',
            //'data'=>$items,
            'url' => ['/aOrganization/ajaxFillTree'],
            'collapsed' => true,
            'unique' => true,
        ]);
        $this->endWidget();
        ?>

        <h5>Parent Family</h5>

        <?php
        $menu = [];

        if (isset($_GET['id']))
            $menu = aOrganization::getParentFamily($_GET['id']);


        $this->widget('booster.widgets.TbTabs', [
            'type' => 'list',
            'tabs' => $menu,
            'htmlOptions' => [

            ]
        ]);
        ?>

        <h5>Current Tree</h5>
        <?php
        if (isset($_GET['id'])) {
            $Hierarchy = aOrganization::model()->findAll(['condition' => 'id = ' . $_GET['id']]);

            foreach ($Hierarchy as $Hierarchy) {
                if ($Hierarchy->parent_id != 0) {
                    $models = aOrganization::model()->findByPk($Hierarchy->id);
                    $items[] = $models->getTree();
                } else
                    $items[] = [];
            }

            $this->beginWidget('CTreeView', [
                'id' => 'module-tree2',
                'data' => $items,
                //'url' => array('/aOrganization/ajaxFillTreeId','id'=>$_GET['id']),
                //'collapsed'=>true,
                //'unique'=>true,
            ]);
            $this->endWidget();
        }
        ?>

    </div>
    <div class="col-md-9">

        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => [
                ['id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabDetail", ["model" => $model], true), 'active' => true],
                ['id' => 'tab2', 'label' => 'User Member', 'content' => $this->renderPartial("_tabUsername", ["model" => $model], true)],
                ['id' => 'tab3', 'label' => 'Logo', 'content' => $this->renderPartial("_tabLogo", ["model" => $model], true)],
            ],
        ]);
        ?>

        <h3>Child Organization</h3>
        <?php
        $this->widget('booster.widgets.TbGridView', [
            'id' => 't-organization-grid',
            'dataProvider' => aOrganization::model()->searchChild($model->id),
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}',
            'columns' => [
                //'branch_code_number',
                'branch_code',
                [
                    'class' => 'ext.booster.widgets.TbButtonColumn',
                    'template' => '{view}',
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'name',
                    'sortable' => false,
                    'editable' => [
                        'url' => $this->createUrl('/aOrganization/updateAjax'),
                        //'placement' => 'right',
                        'inputclass' => 'col-md-3'
                    ]],
                [
                    'header' => 'Company Detail',
                    'type' => 'raw',
                    'value' => function ($data) {
                            return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->custom1)
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->custom2)
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->custom3);
                        },
                ],
                [
                    'header' => 'Info',
                    'type' => 'raw',
                    'value' => function ($data) {
                            return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->address)
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->telephone);
                        },
                ],
                //'fax',
                //'email',
                //'website',
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'status_id',
                    'sortable' => false,
                    'editable' => [
                        'url' => $this->createUrl('/aOrganization/updateAjax'),
                        'type' => 'select2',
                        'source' => sParameter::items('cOrganizationStatus')
                    ]],
                [
                    'class' => 'EJuiDlgsColumn',
                    'template' => '{update}{delete}',
                    //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("aOrganization/delete",array("id"=>$data->id))',
                    'updateDialog' => [
                        'controllerRoute' => 'aOrganization/update',
                        'actionParams' => ['id' => '$data->id'],
                        'dialogTitle' => 'Update Organization',
                        'dialogWidth' => 512, //override the value from the dialog config
                        'dialogHeight' => 530
                    ],
                ],

            ],
        ]);
        ?>


        <h3>New Child Organization</h3>

        <?php echo $this->renderPartial('_form', ['model' => $modelOrganization]); ?>

    </div>
</div>