<?php

$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Permission', 'icon' => 'user', 'url' => Yii::app()->createUrl('/rights'), 'active' => $permission],
        ['label' => 'Roles', 'icon' => 'edit', 'url' => Yii::app()->createUrl('/rights/authItem/roles')],
        ['label' => 'Tasks', 'icon' => 'cog', 'url' => Yii::app()->createUrl('/rights/authItem/tasks')],
        ['label' => 'Operations', 'icon' => 'wrench', 'url' => Yii::app()->createUrl('/rights/authItem/operations')],
    ],
]);
?>

