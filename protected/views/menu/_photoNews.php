<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-camera fa-fw"></i><?php echo Yii::t('basic', ' Photo News') ?>
        </li>
    </ul>
</div>

<div>

    <?php
    $this->widget('ext.albumPhoto', ['dir' => Yii::app()->basePath . "/../shareimages/photo/",
        'columns' => 2,
        'span' => 6,
        'limit' => 6,
        'header' => 5,
        'showDescription' => false
    ]);
    ?>

</div>

<div class="pull-right">
    <p>
        <strong><?php echo CHtml::link('<i class="fa fa-picture fa-fw"></i>All Photo', Yii::app()->createUrl('/site/photo')); ?></strong>
    </p>
</div>

<br/>
