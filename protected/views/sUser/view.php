<?php
$this->breadcrumbs = [
    'User' => ['view'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sUser']],
    ['label' => 'Rights', 'icon' => 'certificate', 'url' => ['/rights/assignment/user', 'id' => $model->id]],
    ['label' => 'Update', 'icon' => 'pencil', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => ['delete', 'id' => $model->id]],
    ['label' => 'Update Password', 'icon' => 'edit', 'url' => ['updatePassword', 'id' => $model->id]],
    ['label' => 'Duplicate', 'icon' => 'upload', 'url' => ['duplicate', 'id' => $model->id]],
    ['label' => ($model->status_id == 1) ? 'Set NON ACTIVE' : 'Set ACTIVE', 'icon' => 'random', 'url' => ['toggleStatus', 'id' => $model->id]],
];

$this->menu2 = sUser::getTopCreated();
$this->menu4 = sUser::getTopLastOneHour();
?>

<div class="page-header">
    <h1>
        <i class="fa fa-user fa-fw"></i>
        <?php echo CHtml::encode($model->username); ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-4">

        <?php
        $Hierarchy = aOrganization::model()->findAll(['condition' => Yii::app()->params['parent_organization_filter']]);

        foreach ($Hierarchy as $Hierarchy) {
            $models = aOrganization::model()->findByPk($Hierarchy->id);
            $items[] = $models->getTreeUser();
        }

        $this->beginWidget('CTreeView', [
            'id' => 'module-tree',
            'data' => $items,
            //'url' => array('/aOrganization/ajaxFillUser'),
            //'collapsed'=>true,
            //'unique'=>true,
        ]);
        $this->endWidget();
        ?>

    </div>
    <div class="col-md-8">
        <?php
        $this->widget('booster.widgets.TbDetailView', [
            'data' => $model,
            'attributes' => [
                'full_name',
                'username',
                //'password',
                [
                    'label' => 'Default Group',
                    'value' => aOrganization::model()->findByPk($model->default_group)->name,
                ],
                [
                    'label' => 'Status',
                    'value' => $model->status->name,
                ],
                [
                    'label' => 'SSO',
                    'type' => 'raw',
                    'value' => CHtml::link($model->sso(), Yii::app()->createUrl('m1/gPerson/view', ['id' => $model->ssoId()])),
                ],
            ],
        ]);
        ?>
        <br/>

        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => [
                ['label' => 'Module and Rights', 'content' => $this->renderPartial("_tabModule", ["model" => $model, "modelModule" => $modelModule], true), 'active' => true],
                //array('label'=>'Rights', 'content'=>$this->renderPartial("_tabRight", array("model"=>$model), true)),
                ['label' => 'Entity Group', 'content' => $this->renderPartial("_tabGroup", ["model" => $model, "modelGroup" => $modelGroup], true)],
                ['label' => 'Notification Group', 'content' => $this->renderPartial("_tabNotifGroup", ["model" => $model], true)],
                ['label' => 'SSO', 'content' => $this->renderPartial("_tabSSO", ["model" => $model], true)],
            ],
        ]);
        ?>

    </div>
</div>
