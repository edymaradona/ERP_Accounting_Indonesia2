<?php
Yii::import('ext.EJuiTooltip', true);
$this->widget('EJuiTooltip', ['selector' => '.tooltip']);
?>

<ul class="nav nav-list">
    <li class="nav-header"><i class="fa fa-fighter-jet fa-fw"></i>Operation</li>
</ul>
<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => $this->menu10,
    'htmlOptions' => [
        // 'style' => 'padding:0',
    ]
]);
?>
<br/>

<ul class="nav nav-list">
    <li class="nav-header"><i class="fa fa-filter fa-fw"></i>Filter By</li>
</ul>
<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => $this->menu7,
    'htmlOptions' => [
        // 'style' => 'padding:0',
    ]
]);
?>
<br/>


