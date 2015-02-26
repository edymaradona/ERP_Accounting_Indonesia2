<?php

/**
 * Bootstrap Carousel images
 *
 * @autor Javier Lema <touzas@gmail.com>
 */
class TCarousel extends CWidget
{

    var $images;
    var $width;
    var $height;
    var $id;

    public function init()
    {

        $dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
        $baseUrl = Yii::app()->getAssetManager()->publish($dir);

        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl . '/bootstrap-carousel.js', CClientScript::POS_END);

        if ($this->id == '')
            $this->id = 'Carousel' . date('YmdHis');

        $cs->registerScript($this->id, '
			$("#' . $this->id . '").carousel();
		', CClientScript::POS_LOAD);
    }

    private function parse2stdClass($array)
    {
        $tmp = new stdClass();
        foreach ($array as $k => $v) {
            $tmp->{$k} = $v;
        }
        return $tmp;
    }

    public function run()
    {
        echo '
			<div id="' . $this->id . '" class="carousel slide" style="min-height:' . $this->height . 'px;">
				<div class="carousel-inner">
		';
        if (is_array($this->images)) {
            foreach ($this->images as $img) {
                $img = $this->parse2stdClass($img);
                $active = ($img->active) ? 'active' : '';
                echo '
					<div class="item ' . $active . '" style="min-height:' . $this->height . 'px;">
				';
                echo CHtml::link(CHtml::image($img->image, $img->alt, ['width' => $this->width, 'height' => $this->height]), $img->url);
                echo '
					</div>
				';
            }
        }
        echo '
				</div>
		';

        echo CHtml::link('&lsaquo;', '#' . $this->id . '', ['class' => 'carousel-control left', 'data-slide' => 'prev']);
        echo CHtml::link('&rsaquo;', '#' . $this->id . '', ['class' => 'carousel-control right', 'data-slide' => 'next']);
        echo '
			</div>
		';
    }
}

?>
