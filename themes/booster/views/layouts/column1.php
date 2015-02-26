<?php $this->beginContent('//layouts/baseFixed'); ?>

<?php //$this->renderPartial('//layouts/_header'); ?>
<?php //$this->renderPartial('//layouts/_navigation'); ?>


<?php $this->renderPartial('//layouts/_breadcrumb'); ?>
<?php $this->renderPartial('//layouts/_notification'); ?>

<?php echo $content; ?>

<?php $this->endContent(); ?>

