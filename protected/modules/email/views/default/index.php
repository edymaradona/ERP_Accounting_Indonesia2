<?php

/**
 * @var $this DefaultController
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
$this->pageTitle = $this->module->getName();
$this->pageHeading = false;

$content = CHtml::tag('p', [], Yii::t('email', 'You may use the following tools to help manage email within your application.'));
foreach (array_keys($this->module->controllerMap) as $controllerName)
    $content .= ' ' . CHtml::link(Yii::t('email', ucfirst($controllerName)), [$controllerName . '/index'], ['class' => 'btn btn-large btn-primary']);
//$this->beginWidget('ext.booster.widgets.TbHeroUnit', array(
//    'heading' => $this->module->getName(),
//'content' => $content,
//));

echo $content;

//$this->endWidget();

