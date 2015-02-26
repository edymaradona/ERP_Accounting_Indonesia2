<div class="page-header">
    <h3>Photo Class Album</h3>
</div>

<?php
$dir = Yii::app()->basePath . "/../shareimages/hr/learning/" . $id;
$contents = scandir($dir, 1);
$counter = 1;
?>

<div class="row">
    <?php
    foreach ($contents as $content) {
        if ($content != "." && $content != ".." && is_file($dir . "/" . $content) === true) {
            ?>
            <div class="col-md-2">
                <div class="thumbnail">
                    <?php
                    $photo = Yii::app()->request->baseUrlCdn . "/shareimages/hr/learning/" . $id . "/" . $content;
                    echo "<a target='_blank' rel='lightbox' href='" . Yii::app()->baseUrl . "/shareimages/hr/learning/" . $id . "/" . $content . "'>" . CHtml::image($photo, 'image') . "</a>";
                    ?>
                </div>
            </div>
            <?php
            $counter++;
        }

        if ($counter === 5)
            break;
    };
    ?>
</div>

