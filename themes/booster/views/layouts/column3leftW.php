<?php $this->beginContent('//layouts/baseFixed'); ?>

<?php //$this->renderPartial('//layouts/_header'); ?>
<?php //$this->renderPartial('//layouts/_navigation'); ?>

<?php $this->renderPartial('//layouts/_notification'); ?>

<div class="row">
    <div class="col-md-3">
        <?php $this->renderPartial('//layouts/_sbLeftFilter'); ?>
    </div>

    <div class="col-md-6">
        <?php echo $content; ?>
    </div>

    <div class="col-md-3">
        <?php $this->renderPartial('//layouts/_sbRightList'); ?>
    </div>

</div>

<?php $this->endContent(); ?>
