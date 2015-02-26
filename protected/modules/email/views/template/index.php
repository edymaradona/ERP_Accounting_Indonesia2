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
Yii::app()->user->setState('index.emailTemplate', Yii::app()->request->requestUri);
$this->pageTitle = Yii::t('email', 'Templates');

// links
$this->menu[] = ['label' => Yii::t('email', 'Create'), 'url' => ['create'], 'linkOptions' => ['class' => 'btn btn-default']];
$this->menu[] = ['label' => Yii::t('email', 'Search'), 'url' => '#', 'linkOptions' => ['class' => 'emailTemplate-grid-search btn btn-default']];
if (Yii::app()->user->getState('index.emailTemplate') != $this->createUrl('index'))
    $this->menu[] = ['label' => Yii::t('email', 'Reset Filters'), 'url' => ['index'], 'linkOptions' => ['class' => 'btn btn-default']];

// message if wrong templateType
if (Yii::app()->emailManager->templateType != 'db') {
    echo CHtml::tag('div', ['class' => 'alert alert-danger'], Yii::t('email', 'EmailManager.templateType is not set to db, these templates will not be used.'));
}

// search
$this->renderPartial('_search', [
    'emailTemplate' => $emailTemplate,
]);

// grid
$this->renderPartial('_grid', [
    'emailTemplate' => $emailTemplate,
]);
