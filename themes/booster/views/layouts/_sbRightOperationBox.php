<?php if (!empty($this->menu9) && (!Yii::app()->user->isGuest)): ?>

    <?php
    $this->renderPartial('/layouts/_search', ['model' => $this->menu9['model'], 'action' => $this->menu9['action']]);
    ?>
    <br/>
<?php endif; ?>


<?php if (!empty($this->menu5) && (!Yii::app()->user->isGuest)): ?>


    <?php
    $_module = (isset($this->module->id)) ? $this->module->id : "";
    $this->widget('booster.widgets.TbButton', [
        'label' => 'Create New ' . $this->menu5[0],
        'buttonType' => 'link',
        'context' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        //'size'=>'large', // '', 'large', 'small' or 'mini'
        //'url'=>Yii::app()->createUrl($this->id.'/create'),	
        'url' => Yii::app()->createUrl($_module . '/' . $this->id . '/create'),
        'block' => true,
        'icon' => 'plus',
    ]);
    ?>
    <br/>

<?php endif; ?>

<?php
if (!empty($this->menu)) {
    $this->beginWidget('booster.widgets.TbPanel', [
        'title' => 'Operation',
        'headerIcon' => 'icon-wrench',
        'htmlOptions' => [
            'class' => 'panel-primary',
        ]
    ]);

    $this->widget('booster.widgets.TbMenu', [
        'type' => 'list',
        'items' => $this->menu,
        'htmlOptions' => [
            //'style' => 'padding:0',
        ]
    ]);

    $this->endWidget();
}
?>

<?php
if (!empty($this->menu1)) {
    $this->beginWidget('booster.widgets.TbPanel', [
        'title' => 'Recently Updated',
        'headerIcon' => 'icon-circle-arrow-up',
        'htmlOptions' => [
            'class' => 'panel-info',
        ]
    ]);

    $this->widget('booster.widgets.TbMenu', [
        'type' => 'list',
        'items' => $this->menu1,
        'htmlOptions' => [
            //'style' => 'padding:0',
        ]
    ]);

    $this->endWidget();
}
?>

<?php
if (!empty($this->menu2)) {
    $this->beginWidget('booster.widgets.TbPanel', [
        'title' => 'Recently Added',
        'headerIcon' => 'icon-circle-arrow-up',
        'htmlOptions' => [
            'class' => 'panel-info',
        ]
    ]);

    $this->widget('booster.widgets.TbMenu', [
        'type' => 'list',
        'items' => $this->menu2,
        'htmlOptions' => [
            //'style' => 'padding:0',
        ]
    ]);

    $this->endWidget();
}
?>

<?php
if (!empty($this->menu3)) {
    $this->beginWidget('booster.widgets.TbPanel', [
        'title' => 'Related',
        'headerIcon' => 'icon-refresh',
        'htmlOptions' => [
            'class' => 'panel-info',
        ]
    ]);

    $this->widget('booster.widgets.TbMenu', [
        'type' => 'list',
        'items' => $this->menu3,
        'htmlOptions' => [
            //'style' => 'padding:0',
        ]
    ]);

    $this->endWidget();
}
?>

<?php
if (!empty($this->menu4)) {
    $this->beginWidget('booster.widgets.TbPanel', [
        'title' => 'Other Menu',
        'headerIcon' => 'icon-star-empty',
        'htmlOptions' => [
            'class' => 'panel-info',
        ]
    ]);

    $this->widget('booster.widgets.TbMenu', [
        'type' => 'list',
        'items' => $this->menu4,
        'htmlOptions' => [
            //'style' => 'padding:0',
        ]
    ]);

    $this->endWidget();
}
?>
