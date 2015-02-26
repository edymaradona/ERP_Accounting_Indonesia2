<?php

if (sCompanyNews::model()->Quote) {

    $this->beginWidget('booster.widgets.TbPanel', [
        'title' => false,
        'headerIcon' => 'fa fa-globe fa-fw',
        //'htmlHeaderOptions' => ['style' => 'background:white'],
        //'htmlContentOptions' => ['style' => 'background:#cbcbcb'],
    ]);

    echo CHtml::tag("h4", [], "<i class='fa fa-quote-right fa-fw'></i>Word of The Day");
    echo "<hr/>";
    echo CHtml::tag("div", ['style' => 'font-size:18px;'], CHtml::decode(sCompanyNews::model()->Quote->content));

    $this->endWidget();
}
