<?php
$this->breadcrumbs = [
    'Rights' => Rights::getBaseUrl(),
    Rights::t('core', 'Roles'),
];
?>


<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Permission', 'icon' => 'user', 'url' => Yii::app()->createUrl('/rights')],
        ['label' => 'Roles', 'icon' => 'edit', 'url' => Yii::app()->createUrl('/rights/authItem/roles'), 'active' => true],
        ['label' => 'Tasks', 'icon' => 'cog', 'url' => Yii::app()->createUrl('/rights/authItem/tasks')],
        ['label' => 'Operations', 'icon' => 'wrench', 'url' => Yii::app()->createUrl('/rights/authItem/operations')],
    ],
]);
?>


<div class="row">
    <div class="col-md-12">

        <div class="page-header">
            <h1>
                <?php echo Rights::t('core', 'Roles'); ?>
            </h1>
        </div>

        <p>
            <?php
            echo CHtml::link(Rights::t('core', 'Create a new role'), ['authItem/create', 'type' => CAuthItem::TYPE_ROLE], [
                'class' => 'add-role-link btn',
            ]);
            ?>
        </p>

        <?php
        $this->widget('booster.widgets.TbGridView', [
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}{summary}',
            'dataProvider' => $dataProvider,
            'template' => '{items}',
            'emptyText' => Rights::t('core', 'No roles found.'),
            'htmlOptions' => ['class' => 'grid-view role-table'],
            'columns' => [
                [
                    'name' => 'name',
                    'header' => Rights::t('core', 'Name'),
                    'type' => 'raw',
                    'htmlOptions' => ['class' => 'name-column'],
                    'value' => '$data->getGridNameLink()',
                ],
                [
                    'name' => 'description',
                    'header' => Rights::t('core', 'Description'),
                    'type' => 'raw',
                    'htmlOptions' => ['class' => 'description-column'],
                ],
                [
                    'name' => 'bizRule',
                    'header' => Rights::t('core', 'Business rule'),
                    'type' => 'raw',
                    'htmlOptions' => ['class' => 'bizrule-column'],
                    'visible' => Rights::module()->enableBizRule === true,
                ],
                [
                    'name' => 'data',
                    'header' => Rights::t('core', 'Data'),
                    'type' => 'raw',
                    'htmlOptions' => ['class' => 'data-column'],
                    'visible' => Rights::module()->enableBizRuleData === true,
                ],
                [
                    'header' => '&nbsp;',
                    'type' => 'raw',
                    'htmlOptions' => ['class' => 'actions-column'],
                    'value' => '$data->getDeleteRoleLink()',
                ],
            ]
        ]);
        ?>

        <p class="info">
            <?php echo Rights::t('core', 'Values within square brackets tell how many children each item has.'); ?>
        </p>

    </div>
</div>
