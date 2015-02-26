<?php

/**
 * Album Photo class file.
 *
 * @author Peter J. Kambey <peterjkambey@gmail.com>
 * @version 0.1
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
class albumPhotoNoLink extends CWidget
{

    public $dir;
    public $columns = 1;
    public $span = 1;
    public $limit = 15;
    public $showTitle = true;
    public $showDescription = true;
    public $header = 3; //title header default h3
    public $descLimit = 30; //Word Description Limit
    public $maxHeight = 100; //Max Height

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
            $filename = explode(".", $content);
            if ($content != ".tmb" && $content != "thumbs" && $content != "." && $content != ".." && ($filename[1] == "JPG" || $filename[1] == "jpg")) {
                if (is_file($this->dir . "/" . $filename[0] . ".xml"))
                    $xml = simplexml_load_file($this->dir . "/" . $filename[0] . ".xml");

                if ($counter == 1) {
                    ?>
                    <div class="row">
                <?php } ?>

                <div class="col-md-<?php echo $this->span ?>">
                    <div class="thumbnail">
                        <?php
                        if (is_file(Yii::app()->basePath . "/../shareimages/photo2/thumbs/" . $filename[0] . ".jpg")) {
                            $photo = Yii::app()->request->baseUrlCdn . "/shareimages/photo2/thumbs/" . $filename[0] . ".jpg";
                        } else
                            $photo = Yii::app()->request->baseUrlCdn . "/shareimages/photo2/" . $filename[0] . ".jpg";

                        echo CHtml::openTag('div', ['style' => 'max-height:' . $this->maxHeight . 'px;overflow:hidden']);
                        echo CHtml::image($photo, 'image', ['width' => '100%']);
                        echo CHtml::closeTag('div');

                        ?>
                        <?php
                        if ($this->showTitle) {
                            if ($this->header == 3) {
                                ?>
                                <h3><? echo (isset($xml)) ? $xml->children()->title : "" ?></h3>
                            <?php } else { ?>
                                <h<?php echo $this->header ?> ><? echo (isset($xml)) ? $xml->children()->title : "" ?></h<?php echo $this->header ?> >
                            <?php
                            }
                        }
                        ?>

                        <p><?php
                            if ($this->showDescription)
                                echo (isset($xml)) ? CHtml::tag('p', ['style' => 'font-size:12px'], peterFunc::shorten_string(strip_tags($xml->children()->description), $this->descLimit)) : "";
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