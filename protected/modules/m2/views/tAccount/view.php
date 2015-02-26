<?php
if (isset($model->getparent->getparent->getparent->account_name)) {
    $this->breadcrumbs = [
        $model->getparent->getparent->getparent->account_name => ['view', 'id' => $model->getparent->getparent->getparent->id],
        $model->getparent->getparent->account_name => ['view', 'id' => $model->getparent->getparent->id],
        $model->getparent->account_name => ['view', 'id' => $model->getparent->id],
        $model->account_name,
    ];
} elseif (isset($model->getparent->getparent->account_name)) {
    $this->breadcrumbs = [
        $model->getparent->getparent->account_name => ['view', 'id' => $model->getparent->getparent->id],
        $model->getparent->account_name => ['view', 'id' => $model->getparent->id],
        $model->account_name,
    ];
} elseif (isset($model->getparent->account_name)) {
    $this->breadcrumbs = [
        $model->getparent->account_name => ['view', 'id' => $model->getparent->id],
        $model->account_name,
    ];
} else {
    $this->breadcrumbs = [
        $model->account_name,
    ];
}


$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/tAccount']],
    ['label' => 'Update', 'icon' => 'edit', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?'],
        'visible' => empty($model->hasJournal)],
    ['label' => 'Generate Empty Balance', 'icon' => 'random', 'visible' => $model->isEmptyBalance, 'url' => ['generate', 'id' => $model->id]],
    ['label' => 'Print Journal List', 'icon' => 'print', 'url' => ['printList', 'id' => $model->id]],
];

$this->menu1 = tAccount::getTopUpdated();
$this->menu2 = tAccount::getTopCreated();
$this->menu3 = tAccount::getTopRelated($model->account_name);
?>

<div class="page-header">
    <h1>
        <?php echo $model->account_no . ". " . $model->account_name; ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-2">

        <h5>All Tree</h5>

        <?php
        $Hierarchy = tAccount::model()->findAll(['condition' => 'parent_id = 0']);

        foreach ($Hierarchy as $Hierarchy) {
            $models = tAccount::model()->findByPk($Hierarchy->id);
            $items[] = $models->getTree();
        }

        $this->beginWidget('CTreeView', [
            'id' => 'module-tree',
            //'data'=>$items,
            'url' => ['/m2/tAccount/ajaxFillTree'],
            //'collapsed'=>true,
            //'unique'=>true,
        ]);
        $this->endWidget();
        ?>

        <h5>Parent Family</h5>

        <?php
        $menu = [];

        if (isset($_GET['id']))
            $menu = tAccount::getParentFamily($_GET['id']);


        $this->widget('booster.widgets.TbMenu', [
            'type' => 'list',
            'items' => $menu,
        ]);
        ?>

        <h5>Current Tree</h5>
        <?php
        if (isset($_GET['id'])) {
            $Hierarchy1 = tAccount::model()->findAll(['condition' => 'id = ' . $_GET['id']]);

            foreach ($Hierarchy1 as $Hie) {
                if ($Hie->parent_id != 0) {
                    $models1 = tAccount::model()->findByPk($Hie->id);
                    $items1[] = $models1->getTree();
                } else
                    $items1[] = [];
            }

            $this->beginWidget('CTreeView', [
                'id' => 'module-tree2',
                'data' => $items1,
                //'url' => array('/aOrganization/ajaxFillTreeId','id'=>$_GET['id']),
                //'collapsed'=>true,
                //'unique'=>true,
            ]);
            $this->endWidget();
        }
        ?>


    </div>
    <div class="col-md-10">

        <?php
        $this->renderPartial('_accountInfo', ['model' => $model]);
        ?>


        <?php
        if ($model->hasChild) {
            $this->widget('booster.widgets.TbTabs', [
                'type' => 'tabs', // 'tabs' or 'pills'
                'tabs' => [
                    ['label' => 'Detail', 'content' => $this->renderPartial("_tabDetail", ["model" => $model, "modelAccount" => $modelAccount], true), 'active' => true],
                    ['label' => 'Entity', 'content' => $this->renderPartial("_tabEntity", ["model" => $model, 'modelEntity' => $modelEntity], true)],
                    ['label' => 'Sub Account', 'content' => $this->renderPartial("_tabSub", ["model" => $model], true)],
                    ['label' => 'Linked Module', 'content' => $this->renderPartial("_tabModule", ["model" => $model], true)],
                ],
            ]);
        } else {
            $this->widget('booster.widgets.TbTabs', [
                'type' => 'tabs', // 'tabs' or 'pills'
                'tabs' => [
                    ['label' => 'Balance', 'content' => $this->renderPartial("_tabBalance", ["model" => $model, "modelAccount" => $modelAccount], true), 'active' => true],
                    //array('label' => 'Detail', 'content' => $this->renderPartial("_tabDetail", array("model" => $model, "modelAccount" => $modelAccount), true)),
                    ['label' => 'Entity', 'content' => $this->renderPartial("_tabEntity", ["model" => $model, 'modelEntity' => $modelEntity], true)],
                    ['label' => 'Sub Account', 'content' => $this->renderPartial("_tabSub", ["model" => $model], true)],
                    ['label' => 'Linked Module', 'content' => $this->renderPartial("_tabModule", ["model" => $model], true)],
                ],
            ]);
        }
        ?>
    </div>
</div>

