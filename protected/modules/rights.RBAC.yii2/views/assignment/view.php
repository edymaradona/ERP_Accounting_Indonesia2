<?php
$this->breadcrumbs = [
    'Rights' => Rights::getBaseUrl(),
    Rights::t('core', 'Assignments'),
];
?>


<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Permission', 'icon' => 'user', 'url' => Yii::app()->createUrl('/rights'), 'active' => true],
        ['label' => 'Roles', 'icon' => 'edit', 'url' => Yii::app()->createUrl('/rights/authItem/roles')],
        ['label' => 'Tasks', 'icon' => 'cog', 'url' => Yii::app()->createUrl('/rights/authItem/tasks')],
        ['label' => 'Operations', 'icon' => 'wrench', 'url' => Yii::app()->createUrl('/rights/authItem/operations')],
    ],
]);
?>

<div class="page-header">
    <h1>
        <?php echo Rights::t('core', 'Assignments'); ?>
    </h1>
</div>

<p>
    <?php echo Rights::t('core', 'Here you can view which permissions has been assigned to each user.'); ?>
</p>

<?php
$this->widget('booster.widgets.TbGridView', [
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'dataProvider' => $dataProvider,
    'template' => "{items}\n{pager}",
    'emptyText' => Rights::t('core', 'No users found.'),
    'htmlOptions' => ['class' => 'grid-view assignment-table'],
    'columns' => [
        [
            'name' => 'name',
            'header' => Rights::t('core', 'Name'),
            'type' => 'raw',
            'htmlOptions' => ['class' => 'name-column'],
            'value' => '$data->getAssignmentNameLink()',
        ],
        [
            'name' => 'assignments',
            'header' => Rights::t('core', 'Roles'),
            'type' => 'raw',
            'htmlOptions' => ['class' => 'role-column'],
            'value' => '$data->getAssignmentsText(CAuthItem::TYPE_ROLE)',
        ],
        [
            'name' => 'assignments',
            'header' => Rights::t('core', 'Tasks'),
            'type' => 'raw',
            'htmlOptions' => ['class' => 'task-column'],
            'value' => '$data->getAssignmentsText(CAuthItem::TYPE_TASK)',
        ],
        [
            'name' => 'assignments',
            'header' => Rights::t('core', 'Operations'),
            'type' => 'raw',
            'htmlOptions' => ['class' => 'operation-column'],
            'value' => '$data->getAssignmentsText(CAuthItem::TYPE_OPERATION)',
        ],
    ]
]);
?>

