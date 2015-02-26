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
$columns = [];
$columns[] = [
    'name' => 'id',
    'value' => 'CHtml::link($data->id, array("spool/view", "id" => $data->id))',
    'type' => 'raw',
];
$columns[] = [
    'name' => 'transport',
];
$columns[] = [
    'name' => 'template',
];
$columns[] = [
    'name' => 'priority',
];
$columns[] = [
    'name' => 'status',
];
$columns[] = [
    'name' => 'model_name',
];
$columns[] = [
    'name' => 'model_id',
];
$columns[] = [
    'name' => 'to_address',
];
$columns[] = [
    'name' => 'from_address',
];
$columns[] = [
    'name' => 'subject',
];
$columns[] = [
    'name' => 'sent',
];
$columns[] = [
    'name' => 'created',
];

// grid
$this->widget('booster.widgets.TbGridView', [
    'id' => 'emailSpool-grid',
    'dataProvider' => $emailSpool->search(),
    'filter' => $emailSpool,
    'columns' => $columns,
]);
