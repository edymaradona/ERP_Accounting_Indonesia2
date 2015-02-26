<?php
$this->breadcrumbs = [
    'Rights' => Rights::getBaseUrl(),
    Rights::t('core', 'Assignments') => ['assignment/view'],
    $model->getName(),
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
        <?php
        echo Rights::t('core', 'Assignments: :username', [
            ':username' => $model->getName()
        ]);
        ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-6">

        <?php
        $this->widget('booster.widgets.TbGridView', [
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}{summary}',
            'dataProvider' => $dataProvider,
            'template' => '{items}',
            'hideHeader' => true,
            'emptyText' => Rights::t('core', 'This user has not been assigned any items.'),
            'htmlOptions' => ['class' => 'grid-view user-assignment-table mini'],
            'columns' => [
                [
                    'name' => 'name',
                    'header' => Rights::t('core', 'Name'),
                    'type' => 'raw',
                    'htmlOptions' => ['class' => 'name-column'],
                    'value' => '$data->getNameText()',
                ],
                [
                    'name' => 'type',
                    'header' => Rights::t('core', 'Type'),
                    'type' => 'raw',
                    'htmlOptions' => ['class' => 'type-column'],
                    'value' => '$data->getTypeText()',
                ],
                [
                    'header' => '&nbsp;',
                    'type' => 'raw',
                    'htmlOptions' => ['class' => 'actions-column'],
                    'value' => '$data->getRevokeAssignmentLink()',
                ],
            ]
        ]);
        ?>

    </div>

    <div class="col-md-6">

        <h3>
            <?php echo Rights::t('core', 'Assign item'); ?>
        </h3>

        <?php if ($formModel !== null): ?>


            <?php
            $this->renderPartial('_form', [
                'model' => $formModel,
                'itemnameSelectOptions' => $assignSelectOptions,
            ]);
            ?>


        <?php else: ?>

        <p class="info">
            <?php echo Rights::t('core', 'No assignments available to be assigned to this user.'); ?>

            <?php endif; ?>

    </div>

</div>
