<div style="min-height:430px">
    <?php
    $dir = Yii::app()->basePath . "/../shareimages/photo";
    $contents = scandir($dir, 1);

    $counter = 1;

    foreach ($contents as $content) {
        $first = false;
        if ($content != "." && $content != ".." && is_dir($dir . "/" . $content) !== true) {
            $filename = explode(".", $content);
            if ($filename[1] === "jpg" || $filename[1] === "JPG" || $filename[1] === "jpeg" || $filename[1] === "JPEG") {
                if (is_file($dir . "/" . $filename[0] . ".xml"))
                    $xml = simplexml_load_file($dir . "/" . $filename[0] . ".xml");

                $photo[$filename[0]] = [
                    //'id' => $filename[0],
                    //'caption' => (isset($xml)) ? $xml->children()->title : '',
                    'image' => Yii::app()->baseUrl . "/shareimages/photo/" . $content,
                    'url' => Yii::app()->createUrl('/site/photoAlbum', ['id' => $filename[0]]),
                    //'url' => Yii::app()->createUrl('/site/photo',[]),
                    'active' => $first,
                    'alt' => 'Alt',
                ];
                $first = true;
                $counter++;
            }
        }

        if ($counter === 6)
            break;
    }
    ?>

    <?php
    //$this->widget('booster.widgets.TbCarousel', [
    $this->widget('ext.Carousel.TCarousel', [
        'images' => $photo,
    ]);
    ?>
</div>

