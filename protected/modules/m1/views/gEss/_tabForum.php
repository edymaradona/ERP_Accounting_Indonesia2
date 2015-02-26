<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <h4>Forum | Bugs Thread </h4>
</div>


<?php
$newthread = '';

$gridColumns = [
    [
        'name' => 'subject',
        'headerHtmlOptions' => ['style' => 'display:none'],
        'type' => 'html',
        'value' => '$data->renderSubjectCell()',
    ],
    [
        'name' => 'postCount',
        'header' => 'Posts',
        'headerHtmlOptions' => ['style' => 'text-align:center;'],
        'htmlOptions' => ['style' => 'width:65px; text-align:center;'],
    ],
    [
        'name' => 'view_count',
        'header' => 'Views',
        'headerHtmlOptions' => ['style' => 'text-align:center;'],
        'htmlOptions' => ['style' => 'width:65px; text-align:center;'],
    ],
    /* array(
      'name' => 'Last post',
      'headerHtmlOptions' => array('style' => 'text-align:center;'),
      'type' => 'html',
      'value' => '$data->renderLastpostCell()',
      'htmlOptions' => array('style' => 'width:200px; text-align:right;'),
      ), */
];

$this->widget('TbGroupGridView', [
    'enableSorting' => false,
    'selectableRows' => 0,
    // 'emptyText'=>'', // No threads? Show nothing
    // 'showTableOnEmpty'=>false,
    //'preHeader' => CHtml::encode($forum->title),
    //'preHeaderHtmlOptions' => array(
    //    'class' => 'preheader',
    //),
    'dataProvider' => $threadsProvider,
    'template' => '{items}',
    'extraRowColumns' => ['is_sticky'],
    'extraRowExpression' => '"<b>".($data->is_sticky?"Sticky threads":"Normal threads")."</b>"',
    'columns' => $gridColumns,
    'htmlOptions' => [
        //'class' => Yii::app()->controller->module->forumTableClass,
    ]
]);
?>