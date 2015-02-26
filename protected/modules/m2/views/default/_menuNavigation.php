<?php

$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => [
        ['label' => 'HOME'],
        ['label' => 'Main Dashboard', 'icon' => 'leaf', 'url' => Yii::app()->createUrl("/m2/default")],
        ['label' => 'HISTORY'],
        ['label' => 'Trial Balance History', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("#")],
    ],
]);
?>
