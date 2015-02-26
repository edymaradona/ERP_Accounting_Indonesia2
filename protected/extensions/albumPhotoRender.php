<?php

/**
 * Album Photo class file.
 *
 * @author Peter J. Kambey <peterjkambey@gmail.com>
 * @version 0.1
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
class albumPhotoRender extends CWidget
{

    public $dir;
    public $id;
    public $columns = 1;
    public $span = 1;
    public $limit = 15;
    public $showTitle = true;
    public $showDescription = true;
    public $header = 3; //title header default h3
    public $descLimit = 30; //Word Description Limit

    public function run()
    {

        //echo CHtml::openTag('ul',array('class'=>"gallery"));

        $contents = scandir($this->dir, 1);
        $counter = 1;
        //$counter2 = 1;

        foreach ($contents as $content) {
            if ($content != "." && $content != ".." && !is_dir($this->dir . "/" . $content) === true) {
                $filename = explode(".", $content);
                if ($filename[1] === "jpg" || $filename[1] === "JPG" || $filename[1] === "jpeg" || $filename[1] === "JPEG") {
                    if (is_file($this->dir . "/" . $this->id . ".xml")) {
                        $xml = simplexml_load_file($this->dir . "/" . $this->id . ".xml");
                        $_title[$filename[0]] = $filename[0];
                        $_desc[$filename[0]] = "";
                        if (isset($xml->children()->files)) {
                            foreach ($xml->children()->files->file as $file) {
                                if ($file->attributes()->name == $filename[0]) {
                                    $_title[$filename[0]] = $file->title;
                                    $_desc[$filename[0]] = $file->description;
                                }
                            }
                        }
                    } else {
                        $_title[$filename[0]] = "";
                        $_desc[$filename[0]] = "";
                    }

                    if ($counter == 1) {

                        echo CHtml::tag('div', ['class' => "row"]);
                    }

                    echo CHtml::tag('div', ['class' => "col-md-2"]);
                    echo CHtml::tag('div', ['class' => "thumbnail"]);

                    if (!is_dir($this->dir . "/thumbs"))
                        mkdir(Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . $this->id . "/thumbs");

                    if (!is_file($this->dir . "/thumbs/" . $content)) {
                        Yii::import('ext.iwi.Iwi');
                        $picture = new Iwi(Yii::app()->basePath . "/../shareimages/photo/" . $this->id . "/" . $content);
                        $picture->resize(200, 200, Iwi::AUTO);
                        $picture->save(Yii::app()->basePath . "/../shareimages/photo/" . $this->id . "/thumbs/" . $content, TRUE);

                        //change permission
                        chmod(Yii::getPathOfAlias('webroot') . "/shareimages/photo/" . $this->id . "/thumbs/" . $content, "0777");
                    }

                    if (is_file($this->dir . "/thumbs/" . $content)) {
                        $photo = Yii::app()->request->baseUrlCdn . "/shareimages/photo/" . $this->id . "/thumbs/" . $content;
                    } else
                        $photo = Yii::app()->request->baseUrlCdn . "/shareimages/photo/" . $this->id . "/" . $content;
                    echo "<a data-toggle='lightbox' href='" . Yii::app()->request->baseUrlCdn . "/shareimages/photo/" . $this->id . "/" . $content . "'>" . CHtml::image($photo, 'image') . "</a>";

                    echo CHtml::tag('h' . $this->header, [], peterFunc::shorten_string($_title[$filename[0]], 3));
                    echo CHtml::tag('p', [], peterFunc::shorten_string($_desc[$filename[0]], 10));
                    echo CHtml::closeTag('div');
                    echo CHtml::closeTag('div');

                    $counter++;
                    if ($counter == $this->columns + 1) {
                        echo CHtml::closeTag('div');
                        echo "<br/>";
                    }

                    if ($counter == $this->columns + 1)
                        $counter = 1;
                }
            }
        };

        if ($counter != $this->columns + 1) {
            echo CHtml::closeTag('div');
        }
        //echo CHtml::closeTag('ul');
    }
}
