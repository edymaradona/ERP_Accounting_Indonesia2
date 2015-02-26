<?php

/**
 * @author Hafid Mukhlasin
 * @license MIT License
 * @version 1.0
 */
class EFullCalendar extends CWidget
{

    /**
     * @var string Google's calendar URL.
     */
    public $googleCalendarUrl;

    /**
     * @var string Theme's CSS file.
     */
    public $themeCssFile;

    /**
     * @var array FullCalendar's options.
     */
    public $options = [];

    /**
     * @var array HTML options.
     */
    public $htmlOptions = [];

    public $enableCdn = false;
    /**
     * @var string PHP file extension. Default is php.
     */
    public $ext = 'php';

    /**
     * Run the widget.
     */
    public function run()
    {

        $this->registerFiles();

        echo $this->showOutput();
    }


    /**
     * Register assets.
     */
    protected function registerFiles()
    {
        $assetsDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . "fullcalendar-2.0.2";

        $assets = Yii::app()->assetManager->publish($assetsDir);

        $cs = Yii::app()->clientScript;
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');

        //$ext=defined('YII_DEBUG') && YII_DEBUG ? 'js' : 'min.js';
        $ext = "min.js";
        $cs->registerScriptFile($this->enableCdn ? "//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment." . $ext :
            $assets . '/lib/moment.' . $ext);
        $cs->registerScriptFile($assets . '/lib/jquery-ui.custom.' . $ext);
        $cs->registerScriptFile($this->enableCdn ? "//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.2/fullcalendar." . $ext :
            $assets . '/fullcalendar.' . $ext);


        $cs->registerCssFile($this->enableCdn ? "//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.2/fullcalendar.css" :
            $assets . '/fullcalendar.css');
        $cs->registerCssFile($assets . '/fullcalendar.print.css', 'print');

        if ($this->googleCalendarUrl) {
            $cs->registerScriptFile($this->enableCdn ? "//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.2/gcal.js" :
                $assets . '/gcal.js');
            $this->options['events'] = $this->googleCalendarUrl;
        }
        if ($this->themeCssFile) {
            $this->options['theme'] = true;
            $cs->registerCssFile($assets . '/lib/' . $this->themeCssFile);
        }

        $js = '$("#' . $this->id . '").fullCalendar(' . CJavaScript::encode($this->options) . ');';
        $cs->registerScript(__CLASS__ . '#' . $this->id, $js, CClientScript::POS_READY);

    }

    /**
     * Returns the html output.
     *
     * @return string Html output
     */
    protected function showOutput()
    {
        if (!isset($this->htmlOptions['id']))
            $this->htmlOptions['id'] = $this->id;

        return CHtml::tag('div', $this->htmlOptions, '');
    }
}
