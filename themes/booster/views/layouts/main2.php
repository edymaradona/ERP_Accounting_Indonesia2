<?php $this->beginContent('//layouts/baseFixed'); ?>

<?php $this->renderPartial('//layouts/_notification'); ?>


<div class="row">
    <div class="col-md-8">
        <?php echo $content; ?>
    </div>


    <div class="col-md-4">
        <?php $this->renderPartial('//layouts/_sbRightNotification'); ?>
    </div>

    <?php /*
      <div class="col-md-3">
      <?php $this->renderPartial('/layouts/_sbRightMenuBox'); ?>
      </div>
     */
    ?>

</div>


<?php $this->endContent(); ?>
