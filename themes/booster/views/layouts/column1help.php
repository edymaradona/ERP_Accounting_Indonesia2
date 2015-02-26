<?php $this->beginContent('//layouts/baseFixedNoNavBar'); ?>

<?php //$this->renderPartial('//layouts/_header'); ?>
<?php //$this->renderPartial('//layouts/_navigation'); ?>


<?php $this->renderPartial('//layouts/_breadcrumb'); ?>
<?php $this->renderPartial('//layouts/_notification'); ?>

<div class="row">
    <div class="col-md-3">
        <?php $this->renderPartial('//layouts/_sbLeftFilter'); ?>

        <?php
        $Hierarchy = sHelp::model()->findAll(['condition' => 'id = 1']);

        foreach ($Hierarchy as $Hierarchy) {
            $models = sHelp::model()->findByPk($Hierarchy->id);
            $items[] = $models->getTree();
        }

        $this->beginWidget('CTreeView', [
            'id' => 'module-tree2',
            'data' => $items,
            //'url' => array('/aOrganization/ajaxFillTreeId','id'=>$_GET['id']),
            'collapsed' => true,
            //'unique'=>true,
        ]);
        $this->endWidget();
        ?>
    </div>
    <div class="col-md-9">

        <?php echo $content; ?>

    </div>
</div>


<?php $this->endContent(); ?>

