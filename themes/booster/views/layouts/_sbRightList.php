<?php if (!empty($this->menu5) && (!Yii::app()->user->isGuest)): ?>

    <br/>

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

<?php /*
  <?php
  $this->beginWidget('booster.widgets.TbPanel', array(
  'title' => 'Operation',
  'headerIcon' => 'icon-wrench',
  ));

  $this->widget('booster.widgets.TbMenu', array(
  'type'=>'list',
  'items'=>$this->menu,
  ));

  $this->endWidget();
  ?>

 */
?>

<?php
$this->beginWidget('booster.widgets.TbPanel', [
    'title' => 'Top Interview',
    'headerIcon' => 'icon-wrench',
    'htmlOptions' => [
        'class' => 'panel-info',
    ]
]);

$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => $this->menu4,
    'htmlOptions' => [
        // 'style' => 'padding:0',
    ]
]);

$this->endWidget();
?>


<?php
$this->beginWidget('booster.widgets.TbPanel', [
    'title' => 'Top Recent',
    'headerIcon' => 'icon-wrench',
    'htmlOptions' => [
        'class' => 'panel-info',
    ]
]);

$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => $this->menu8,
    'htmlOptions' => [
        // 'style' => 'padding:0',
    ]
]);

$this->endWidget();
