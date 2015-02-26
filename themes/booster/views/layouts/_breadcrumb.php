<?php //if (!Yii::app()->user->isGuest) {   ?>

<div class="row">
    <div class="col-md-12">
        <?php if (isset($this->breadcrumbs)): ?>
            <?php
            $this->widget('booster.widgets.TbBreadcrumbs', [
                'links' => $this->breadcrumbs,
                'separator' => '/',
                'htmlOptions' => [
                    'style' => 'margin-top:4px',
                    'class' => 'breadcrumb'
                ]
            ]);
            ?>
        <?php endif ?>
    </div>
</div>

<?php //}  ?>
