<?php
$model = sCompanyNews::model()->fullArticle;
if ($model) {
    ?>


    <?php
    $this->beginWidget('booster.widgets.TbPanel', [
        'title' => false,
        'headerIcon' => 'fa fa-globe fa-fw',
    ]);
    ?>

    <div class="page-header">
        <h2><?php echo $model->title; ?></h2>
    </div>

    <div class="small">
        <?php
        echo "by " . $model->created->username;
        echo " on  " . date('d-m-Y', $model->created_date);
        ?>
    </div>

    <?php
    echo "<br/>";
    $this->beginWidget('CMarkdown', ['purifyOutput' => true]);
    echo $model->content;
    $this->endWidget();
    ?>

    <br/>
    <h6>Related Story:</h6>

    <?php $this->endWidget(); ?>

<?php
}
