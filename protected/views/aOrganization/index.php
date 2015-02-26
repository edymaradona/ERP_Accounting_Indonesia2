<?php
$this->breadcrumbs = [
    'Organization Structure',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/aOrganization']],
];

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
$this->menu5 = ['Organization'];
?>


<div class="page-header">
    <h1>
        <i class="fa fa-image"></i>
        Organization Structure</h1>
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
        $this->renderPartial('_search', [
            'model' => $model,
        ]);
        ?>

        <?php
        $this->widget('zii.widgets.CListView', [
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
        ]);
        ?>

    </div>
</div>