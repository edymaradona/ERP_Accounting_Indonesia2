<?php
$this->breadcrumbs = [
    'Rights' => Rights::getBaseUrl(),
    Rights::getAuthItemTypeNamePlural($model->type) => Rights::getAuthItemRoute($model->type),
    $model->name,
];
?>

<?php
//$this->renderPartial('/assignment/_menu');
?>

<div class="page-header">
    <h1>
        <?php
        echo Rights::t('core', 'Update :name', [
            ':name' => $model->name,
            ':type' => Rights::getAuthItemTypeName($model->type),
        ]);
        ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-6">
        <?php $this->renderPartial('_form', ['model' => $formModel]); ?>
    </div>
    <div class="col-md-6">

        <h3>
            <?php echo Rights::t('core', 'Relations'); ?>
        </h3>

        <?php if ($model->name !== Rights::module()->superuserName): ?>

            <h4>
                <?php echo Rights::t('core', 'Parents'); ?>
            </h4>

            <?php
            $this->widget('booster.widgets.TbGridView', [
                'itemsCssClass' => 'table table-striped table-bordered',
                'template' => '{items}{pager}{summary}',
                'dataProvider' => $parentDataProvider,
                'template' => '{items}',
                'hideHeader' => true,
                'emptyText' => Rights::t('core', 'This item has no parents.'),
                'htmlOptions' => ['class' => 'grid-view parent-table mini'],
                'columns' => [
                    [
                        'name' => 'name',
                        'header' => Rights::t('core', 'Name'),
                        'type' => 'raw',
                        'htmlOptions' => ['class' => 'name-column'],
                        'value' => '$data->getNameLink()',
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
                        'value' => '',
                    ],
                ]
            ]);
            ?>


            <h4>
                <?php echo Rights::t('core', 'Children'); ?>
            </h4>

            <?php
            $this->widget('booster.widgets.TbGridView', [
                'itemsCssClass' => 'table table-striped table-bordered',
                'template' => '{items}{pager}{summary}',
                'dataProvider' => $childDataProvider,
                'template' => '{items}',
                'hideHeader' => true,
                'emptyText' => Rights::t('core', 'This item has no children.'),
                'htmlOptions' => ['class' => 'grid-view parent-table mini'],
                'columns' => [
                    [
                        'name' => 'name',
                        'header' => Rights::t('core', 'Name'),
                        'type' => 'raw',
                        'htmlOptions' => ['class' => 'name-column'],
                        'value' => '$data->getNameLink()',
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
                        'value' => '$data->getRemoveChildLink()',
                    ],
                ]
            ]);
            ?>


            <h4>
                <?php echo Rights::t('core', 'Add Child'); ?>
            </h4>

            <?php if ($childFormModel !== null): ?>

                <?php
                $this->renderPartial('_childForm', [
                    'model' => $childFormModel,
                    'itemnameSelectOptions' => $childSelectOptions,
                ]);
                ?>

            <?php else: ?>

                <p class="info">
                <?php echo Rights::t('core', 'No children available to be added to this item.'); ?>

            <?php endif; ?>


        <?php else: ?>


            <p class="info">
                <?php echo Rights::t('core', 'No relations need to be set for the superuser role.'); ?>
                <br/>
                <?php echo Rights::t('core', 'Super users are always granted access implicitly.'); ?>
            </p>

        <?php endif; ?>

    </div>

</div>
