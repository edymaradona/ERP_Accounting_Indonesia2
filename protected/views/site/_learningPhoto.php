<h3>
    <i class="fa fa-picture-o fa-fw"></i>
    Learning Photo Activity
</h3>

<?php
$dir = Yii::app()->basePath . "/../shareimages/hr/learning";
$contents = scandir($dir, 1);
$counter = 1;
$counterdir = 1;
?>


<?php
foreach ($contents as $content) {
    if ($content != "." && $content != ".." && is_dir($dir . "/" . $content) === true) {
        ?>

        <?php if ($counter == 1) { ?>
            <div class="row">
        <?php } ?>

        <div class="col-md-6">
            <div class="thumbnail">
                <?php
                $dir2 = Yii::app()->basePath . "/../shareimages/hr/learning/" . $content;
                $contents2 = scandir($dir2, 1);

                $photo = Yii::app()->request->baseUrlCdn . "/shareimages/hr/learning/" . $content . "/" . $contents2[0];
                //echo CHtml::link(CHtml::image($photo, 'image'),Yii::app()->createUrl("site/photoAlbum",array("id"=>$contents2[0])));
                echo CHtml::image($photo);
                ?>
            </div>
        </div>

        <?php
        $counter++;
        if ($counter == 3) {
            ?>
            </div>
        <?php
        }

        if ($counter == 3)
            $counter = 1;
    }

    $counterdir++;

    if ($counterdir == 7)
        break;
};
?>

<?php if ($counter != 1) { ?>
    </div>
<?php } ?>

