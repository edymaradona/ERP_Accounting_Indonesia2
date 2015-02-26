<?php if (!empty($this->menu9) && (!Yii::app()->user->isGuest)): ?>

    <?php
    $this->renderPartial('/layouts/_search', ['model' => $this->menu9['model'], 'action' => $this->menu9['action']]);
    ?>
    <br/>
    
<?php endif; ?>

<?php if (!empty($this->menu5)): ?>

    <br/>
    <?php
    $module = (isset($this->module->id)) ? $this->module->id . '/' : '';

    $this->widget('booster.widgets.TbButton', [
        'label' => 'Create New ' . $this->menu5[0],
        'buttonType' => 'link',
        'context' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        //'size'=>'large', // '', 'large', 'small' or 'mini'
        'url' => Yii::app()->createUrl($module . $this->id . '/create'),
        'block' => true,
        'icon' => 'plus',
    ]);
    ?>
    <br/>

<?php endif; ?>

<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <h5><i class="fa fa-cogs fa-fw"></i> Navigation</h5>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => $this->menu4,
    'encodeLabel' => false,
    'htmlOptions' => [
        // 'style' => 'padding:0',
    ]
]);
?>
<br/>

<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <h5><i class="fa fa-fighter-jet fa-fw"></i> Operation</h5>
</div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'encodeLabel' => false,
    'items' => $this->menu,
    'htmlOptions' => [
        // 'style' => 'padding:0',
    ]
]);
?>
<br/>

<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <h5><i class="fa fa-print fa-fw"></i> Report</h5>
</div>
<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => $this->menu1,
    'encodeLabel' => false,
    'htmlOptions' => [
        // 'style' => 'padding:0',
    ]
]);
?>
<br/>

<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <h5><i class="fa fa-list-ul fa-fw"></i> Quick List</h5>
</div>
<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => $this->menu7,
    'encodeLabel' => false,
    'htmlOptions' => [
        // 'style' => 'padding:0',
    ]
]);
?>
<br/>

<?php if (!empty($this->menu8)): ?>

    <div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
        <h5><i class="fa fa-coffee fa-fw"></i> News Archived</h5>
    </div>
    <?php
    $this->widget('booster.widgets.TbMenu', [
        'type' => 'list',
        'items' => $this->menu8,
        'encodeLabel' => false,
        'htmlOptions' => [
            // 'style' => 'padding:0',
        ]
    ]);
    ?>
    <br/>

<?php endif; ?>

<?php if (!empty($this->menu11)): ?>

    <div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
        <h5><i class="fa fa-windows fa-fw"></i> Applicant Job Title Tag</h5>
    </div>

    <?php
    $counter = 0;
    foreach ($this->menu11 as $key => $list) {
        echo CHtml::link($key, Yii::app()->createUrl('m1/hApplicant/index', ['tag' => $key]));
        echo " ";

    }
    ?>
    <br/>

<?php endif; ?>
