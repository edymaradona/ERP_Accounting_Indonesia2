<?php
$model = sCompanyNews::model()->Announcement;

if ($model != false) {
    ?>

    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <h4><i class="fa fa-bars fa-fw"></i><?php echo Yii::t('basic', ' Announcement') ?></h4>
    </div>
    <?php
    $this->beginWidget('booster.widgets.TbPanel', [
        'title' => false,
        'headerIcon' => 'fa fa-globe fa-fw',
        'htmlOptions' => [
            'class' => 'panel-info',
        ]
    ]);
    ?>

    <h4><?php echo $model->title; ?></h4>
    <small><?php echo $model->publish_date ?><br/></small>

    <?php
    $this->beginWidget('CMarkdown', ['purifyOutput' => true]);
    echo $model->content;
    $this->endWidget();
    ?>

    <p class="pull-right">
        <small>
            Expire Time: <?php echo peterFunc::nicetime(strtotime($model->expire_date)) ?>
        </small>
    </p>

    <?php
    $this->endWidget();
}
?>


