<?php

$this->beginWidget('booster.widgets.TbPanel', [
    'title' => 'Navigation',
    'headerIcon' => 'icon-wrench',
    'htmlOptions' => [
        'class' => 'panel-info',
    ]
]);

$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => [
        ['label' => 'Home', 'url' => Yii::app()->createUrl('/site/login'), 'visible' => Yii::app()->user->isGuest],
        ['label' => 'Home', 'url' => Yii::app()->createUrl('/menu'), 'visible' => !Yii::app()->user->isGuest],
        //array('label'=>'Photo Gallery', 'url'=>Yii::app()->createUrl('/sGallery'),'visible'=>Yii::app()->user->isGuest),
    ],
]);

$this->endWidget();
?>


