<?php
$model = sCompanyNews::model()->AnnouncementUnit;

if ($model != false) {
    ?>

    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <h4>Announcement</h4>
    </div>

    <?php
    $this->beginWidget('booster.widgets.TbPanel', [
        'title' => false,
        'headerIcon' => 'fa fa-globe fa-fw',
        //'htmlHeaderOptions' => ['style' => 'background:white'],
        //'htmlContentOptions' => ['style' => 'background:#cbcbcb'],
    ]);
    ?>

    <h4><?php echo $model->title; ?></h4>
    <small><?php echo $model->publish_date ?><br/></small>

    <?php
    $this->beginWidget('CMarkdown', ['purifyOutput' => true]);
    //echo $model->content;
    echo peterFunc::shorten_string($model->content, 100);

    $this->endWidget();

    echo CHtml::link('Read More >>>', Yii::app()->createUrl('/m1/gEss/viewAnnouncement', ['id' => $model->id]));
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


