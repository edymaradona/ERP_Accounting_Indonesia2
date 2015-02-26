<?php

/**
 * Album Photo class file.
 *
 * @author Peter J. Kambey <peterjkambey@gmail.com>
 * @version 0.1
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
class albumPhoto extends CWidget
{

    public $dir;
    public $columns = 1;
    public $span = 1;
    public $limit = 15;
    public $showTitle = true;
    public $showDescription = true;
    public $header = 3; //title header default h3
    public $descLimit = 30; //Word Description Limit
    public $maxHeight = 190; //Max Height

    public function run()
    {
        $contents = scandir($this->dir, 1);
        $counter = 1;
        $counter2 = 1;

        if (empty($this->dir)) {
            throw new CException('AlbumPhoto: param "dir" cannot be empty.');
        }

        if (!is_numeric($this->columns) || !is_numeric($this->span) || !is_numeric($this->limit) || !is_numeric($this->header) || !is_numeric($this->descLimit)) {
            throw new CException('AlbumPhoto: param "columns,span,limit, header or descLimit" must be integer.');
        }


        foreach ($contents as $content) {
            if ($content != "thumbs" && $content != ".tmb" && $content != "." && $content != ".." && is_dir($this->dir . "/" . $content) === true) {
                if (is_file($this->dir . "/" . $content . ".xml"))
                    $xml = simplexml_load_file($this->dir . "/" . $content . ".xml");

                if ($counter == 1) {
                    ?>
                    <div class="row">
                <?php } ?>

                <div class="col-md-<?php echo $this->span ?>">
                    <div class="thumbnail">
                        <?php
                        if (is_file(Yii::app()->basePath . "/../shareimages/photo/" . $content . ".jpg")) {
                            $photo = Yii::app()->request->baseUrlCdn . "/shareimages/photo/" . $content . ".jpg";
                        } else
                            $photo = Yii::app()->request->baseUrlCdn . "/shareimages/photo/" . $content . ".JPG";

                        echo CHtml::openTag('div', ['style' => 'max-height:' . $this->maxHeight . 'px;overflow:hidden']);
                        echo CHtml::link(CHtml::image($photo, 'image', ['width' => '100%']), Yii::app()->createUrl("site/photoAlbum", ["id" => $content]));
                        echo CHtml::closeTag('div');
                        ?>
                        <?php
                        if ($this->showTitle) {
                            if ($this->header == 3) {
                                ?>
                                <h3><? echo (isset($xml)) ? $xml->children()->title : "" ?></h3>
                                <p><? echo (isset($xml)) ? $xml->children()->publish_date : "" ?></p>
                            <?php } else { ?>
                                <h<?php echo $this->header ?> ><? echo (isset($xml)) ? $xml->children()->title : "" ?></h<?php echo $this->header ?> >
                                <p><? echo (isset($xml)) ? $xml->children()->publish_date : "" ?></p>
                            <?php
                            }
                        }
                        ?>

                        <p><?php
                            if ($this->showDescription)
                                echo (isset($xml)) ? peterFunc::shorten_string(strip_tags($xml->children()->description), $this->descLimit) : "";
                            ?>
                        </p>
                    </div>
                </div>

                <?php
                $counter++;
                $counter2++;

                if ($counter == $this->columns + 1) {
                    ?>
                    </div>
                <?php
                }


                if ($counter == $this->columns + 1)
                    $counter = 1;

                if ($counter2 === $this->limit + 1)
                    break;
            }
        };
        ?>

        <?php if ($counter != 1) { ?>
        </div>
    <?php
    }
    }

}