<?php

$isAdmin = !Yii::app()->user->isGuest && (Yii::app()->user->name == "admin");

$gridColumns = [
    [
        'name' => 'Forum',
        'headerHtmlOptions' => ['colspan' => '2'],
        'type' => 'html',
        'value' => 'CHtml::image(Yii::app()->controller->module->registerImage("on.gif"), "On")',
        'htmlOptions' => ['style' => 'width:22px;'],
    ],
    [
        'name' => 'forum',
        'headerHtmlOptions' => ['style' => 'display:none'],
        'type' => 'html',
        'value' => '$data->renderForumCell()',
    ],
    [
        'name' => 'threadCount',
        'headerHtmlOptions' => ['style' => 'text-align:center;'],
        'header' => 'Threads',
        'htmlOptions' => ['style' => 'width:65px; text-align:center;'],
    ],
    [
        'name' => 'postCount',
        'headerHtmlOptions' => ['style' => 'text-align:center;'],
        'header' => 'Posts',
        'htmlOptions' => ['style' => 'width:65px; text-align:center;'],
    ],
    [
        'name' => 'Last post',
        'headerHtmlOptions' => ['style' => 'text-align:center;'],
        'type' => 'html',
        'value' => '$data->renderLastpostCell()',
        'htmlOptions' => ['style' => 'width:200px; text-align:right;'],
    ],
];

if (isset($inforum) && $inforum == true)
    $preheader = '<div style="text-align:center;">Forums in "' . CHtml::encode($forum->title) . '"</div>';
else
    $preheader = CHtml::link(CHtml::encode($forum->title), $forum->url);

// Add some admin controls
if ($isAdmin) {
    $deleteConfirm = "Are you sure? All subforums and threads are permanently deleted as well!";

    $adminheader = '<div class="admin" style="float:right; font-size:smaller;width:250px">' .
        CHtml::link('New forum', ['/forum/forum/create', 'parentid' => $forum->id], ['style' => 'display:inline']) . ' | ' .
        CHtml::link('Edit', ['/forum/forum/update', 'id' => $forum->id], ['style' => 'display:inline']) . ' | ' .
        CHtml::ajaxLink('Delete category', ['/forum/forum/delete', 'id' => $forum->id], ['type' => 'POST', 'success' => 'function(){document.location.reload(true);}'], ['confirm' => $deleteConfirm, 'style' => 'display:inline']) .
        '</div>';

    $preheader = $adminheader . $preheader;

    // Admin links to show in extra column
    $gridColumns[] = [
        'class' => 'TbButtonColumn',
        'header' => 'Admin',
        'template' => '{delete}{update}',
        'deleteConfirmation' => "js:'" . $deleteConfirm . "'",
        'afterDelete' => 'function(){document.location.reload(true);}',
        'buttons' => [
            'delete' => ['url' => 'Yii::app()->createUrl("/forum/forum/delete", array("id"=>$data->id))'],
            'update' => ['url' => 'Yii::app()->createUrl("/forum/forum/update", array("id"=>$data->id))'],
        ],
        'htmlOptions' => ['style' => 'width:40px;'],
    ];
}

$this->widget('forum.extensions.groupgridview.GroupGridView', [
    'enableSorting' => false,
    'summaryText' => '',
    'selectableRows' => 0,
    'emptyText' => 'No forums found',
    'showTableOnEmpty' => $isAdmin,
    'preHeader' => $preheader,
    'preHeaderHtmlOptions' => [
        'class' => 'preheader',
    ],
    'dataProvider' => $subforums,
    'columns' => $gridColumns,
    'htmlOptions' => [
        'class' => Yii::app()->controller->module->forumTableClass,
    ]
]);
