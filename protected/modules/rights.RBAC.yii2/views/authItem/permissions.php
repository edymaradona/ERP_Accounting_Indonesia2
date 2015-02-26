<?php
$this->breadcrumbs = [
    'Rights' => Rights::getBaseUrl(),
    Rights::t('core', 'Permissions'),
];
?>

<div class="row">
    <div class="col-md-12">

        <div class="page-header">
            <h1>
                <?php echo Rights::t('core', 'Permissions'); ?>
            </h1>
        </div>

        <p>
            <?php echo Rights::t('core', 'Here you can view and manage the permissions assigned to each role.'); ?>
            <br/>
            <?php
            echo Rights::t('core', 'Authorization items can be managed under {roleLink}, {taskLink} and {operationLink}.', [
                '{roleLink}' => CHtml::link(Rights::t('core', 'Roles'), ['authItem/roles']),
                '{taskLink}' => CHtml::link(Rights::t('core', 'Tasks'), ['authItem/tasks']),
                '{operationLink}' => CHtml::link(Rights::t('core', 'Operations'), ['authItem/operations']),
            ]);
            ?>
        </p>

        <p>
            <?php //echo CHtml::link(Rights::t('core', 'Generate items for controller actions'), array('authItem/generate'), array('class'=>'generator-link btn',)); 
            ?>
        </p>

        <?php
        $this->widget('booster.widgets.TbGridView', [
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}{summary}',
            'dataProvider' => $dataProvider,
            'template' => '{items}',
            'emptyText' => Rights::t('core', 'No authorization items found.'),
            'htmlOptions' => ['class' => 'grid-view permission-table'],
            'columns' => $columns,
        ]);
        ?>

        <p class="info">
            *)
            <?php echo Rights::t('core', 'Hover to see from where the permission is inherited.'); ?>
        </p>

        <script type="text/javascript">

            /**
             * Attach the tooltip to the inherited items.
             */
            jQuery('.inherited-item').rightsTooltip({
                title: '<?php echo Rights::t('core', 'Source'); ?>: '
            });

            /**
             * Hover functionality for rights' tables.
             */
            $('#rights tbody tr').hover(function () {
                $(this).addClass('hover'); // On mouse over
            }, function () {
                $(this).removeClass('hover'); // On mouse out
            });

        </script>

    </div>
</div>
