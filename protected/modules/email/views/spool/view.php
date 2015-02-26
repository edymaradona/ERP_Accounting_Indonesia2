<?php

/**
 * @var $this EmailSpoolController
 * @var $emailSpool EmailSpool
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
$this->pageTitle = Yii::t('email', 'Spool ID-:id', [':id' => $emailSpool->id]);

// links
$this->menu[] = ['label' => Yii::t('email', 'Preview'), 'url' => ['preview', 'id' => $emailSpool->id], 'linkOptions' => ['class' => 'btn btn-default fancybox', 'data-fancybox-type' => 'iframe']];

$attributes = [];
$attributes[] = [
    'name' => 'id',
];
$attributes[] = [
    'name' => 'transport',
];
$attributes[] = [
    'name' => 'template',
];
$attributes[] = [
    'name' => 'priority',
];
$attributes[] = [
    'name' => 'status',
];
$attributes[] = [
    'name' => 'model_name',
];
$attributes[] = [
    'name' => 'model_id',
];
$attributes[] = [
    'name' => 'to_address',
];
$attributes[] = [
    'name' => 'from_address',
];
$attributes[] = [
    'name' => 'subject',
];
$attributes[] = [
    'name' => 'sent',
    'value' => $emailSpool->sent ? Yii::app()->format->formatDatetime($emailSpool->sent) : null,
];
$attributes[] = [
    'name' => 'created',
    'value' => Yii::app()->format->formatDatetime($emailSpool->created),
];
$this->widget('zii.widgets.CDetailView', [
    'data' => $emailSpool,
    'attributes' => $attributes,
    'htmlOptions' => [
        'class' => 'table table-condensed table-striped',
    ],
]);

// message
echo CHtml::tag('h2', [], Yii::t('email', 'Message'));
echo CHtml::tag('pre', [], CHtml::encode($emailSpool->swiftMessage->getBody()));

// other parts
foreach ($emailSpool->swiftMessage->getChildren() as $child) {
    /** @var Swift_MimePart $child */
    echo CHtml::tag('h2', [], $child->getContentType());
    echo CHtml::tag('pre', [], CHtml::encode($child->getBody()));
}
