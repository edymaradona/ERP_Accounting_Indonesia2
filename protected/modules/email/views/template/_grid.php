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
$columns = [];
$columns[] = [
    'name' => 'id',
    'value' => 'CHtml::link($data->id, array("template/view", "id" => $data->id))',
    'type' => 'raw',
];
$columns[] = [
    'name' => 'name',
];
$columns[] = [
    'name' => 'subject',
];
$columns[] = [
    'name' => 'heading',
];

// grid
$this->widget('booster.widgets.TbGridView', [
    'id' => 'emailTemplate-grid',
    'dataProvider' => $emailTemplate->search(),
    'filter' => $emailTemplate,
    'columns' => $columns,
]);
