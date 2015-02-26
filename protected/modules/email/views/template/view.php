<?php

/**
 * @var $this EmailTemplateController
 * @var $emailTemplate EmailTemplate
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
$this->pageTitle = Yii::t('email', 'Template ID-:id', [':id' => $emailTemplate->id]);

// links
$this->menu[] = ['label' => Yii::t('email', 'Update'), 'url' => ['update', 'id' => $emailTemplate->id], 'linkOptions' => ['class' => 'btn btn-default']];
$this->menu[] = ['label' => Yii::t('email', 'Preview'), 'url' => ['preview', 'id' => $emailTemplate->id], 'linkOptions' => ['class' => 'btn btn-default fancybox', 'data-fancybox-type' => 'iframe']];

// details
$attributes = [];
$attributes[] = [
    'name' => 'id',
];
$attributes[] = [
    'name' => 'name',
];
$attributes[] = [
    'name' => 'subject',
];
$attributes[] = [
    'name' => 'heading',
];

$this->widget('zii.widgets.CDetailView', [
    'data' => $emailTemplate,
    'attributes' => $attributes,
    'htmlOptions' => [
        'class' => 'table table-condensed table-striped',
    ],
]);

// message
echo CHtml::tag('h2', [], Yii::t('email', 'Message'));
echo CHtml::tag('pre', [], CHtml::encode($emailTemplate->message));
