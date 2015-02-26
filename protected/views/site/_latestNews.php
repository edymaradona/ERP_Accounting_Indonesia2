<style>
    .ticker {
        height: 250px;
        overflow: hidden;
    }

    #ticker_02 {
        height: 250px;
    }

    .ticker li {
        height: 280px;
    }
</style>

<?php
$models = sCompanyNews::model()->latestNews;

if ($models) {
    ?>

    <?php
    $this->beginWidget('booster.widgets.TbPanel', [
        'title' => false,
        'headerIcon' => 'fa fa-globe fa-fw',
       'htmlOptions' => [
            'class' => 'panel-info',
        ]
    ]);
    ?>

    <ul id="ticker_02" class="ticker" style="margin:0;padding:0;list-style-type: none;";>

        <?php foreach ($models as $model) { ?>
        <li>
            <h4><?php echo CHtml::link(CHtml::encode($model->title), Yii::app()->createUrl('/sCompanyNews/view', ["id" => $model->id])); ?></h4>
            <?php
            //$this->beginWidget('CMarkdown', array('purifyOutput' => true));
            $_desc = peterFunc::shorten_string(strip_tags($model->content), 38);
            echo $_desc;
            //$this->endWidget();
            ?>
        </li>

    <?php } ?>
    </ul>
    <?php $this->endWidget(); ?>

    <?php
}
?>

<script>

    function tick2() {
        $('#ticker_02 li:first').animate({'opacity': 0}, 400, function () {
            $(this).appendTo($('#ticker_02')).css('opacity', 1);
        });
    }
    setInterval(function () {
        tick2()
    }, 3000);


</script>