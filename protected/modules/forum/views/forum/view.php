<?php

$this->widget('zii.widgets.CBreadcrumbs', [
    'links' => $forum->getBreadcrumbs(),
]);

$this->renderPartial('_subforums', [
    'inforum' => true,
    'forum' => $forum,
    'subforums' => $subforumsProvider,
]);
?>

    <br/>

<?php
$newthread = $forum->is_locked ? '' : '<div class="newthread pull-right">' . CHtml::link(CHtml::image(Yii::app()->controller->module->registerImage("newthread.gif")), ['/forum/thread/create', 'id' => $forum->id]) . '</div>';

$gridColumns = [
    [
        'name' => 'Thread / Author',
        'headerHtmlOptions' => ['colspan' => '2'],
        'type' => 'html',
        'value' => 'CHtml::image(Yii::app()->controller->module->registerImage("folder". ($data->is_locked?"locked":"") .".gif"), ($data->is_locked?"Locked":"Unlocked"), array("title"=>$data->is_locked?"Thread locked":"Thread unlocked"))',
        'htmlOptions' => ['style' => 'width:20px;'],
    ],
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
    [
        'name' => 'Last post',
        'headerHtmlOptions' => ['style' => 'text-align:center;'],
        'type' => 'html',
        'value' => '$data->renderLastpostCell()',
        'htmlOptions' => ['style' => 'width:200px; text-align:right;'],
    ],
];

// For admins, add column to delete and lock/unlock threads
$isAdmin = !Yii::app()->user->isGuest && (Yii::app()->user->name == "admin");
if ($isAdmin) {
    // Admin links to show in extra column
    $deleteConfirm = "Are you sure? All posts are permanently deleted as well!";
    $gridColumns[] = [
        'class' => 'TbButtonColumn',
        'header' => 'Admin',
        'template' => '{delete}{update}',
        'deleteConfirmation' => "js:'" . $deleteConfirm . "'",
        'afterDelete' => 'function(){document.location.reload(true);}',
        'buttons' => [
            'delete' => ['url' => 'Yii::app()->createUrl("/forum/thread/delete", array("id"=>$data->id))'],
            'update' => ['url' => 'Yii::app()->createUrl("/forum/thread/update", array("id"=>$data->id))'],
        ],
        'htmlOptions' => ['style' => 'width:40px;'],
    ];
}

$this->widget('forum.extensions.groupgridview.GroupGridView', [
    'enableSorting' => false,
    'selectableRows' => 0,
    // 'emptyText'=>'', // No threads? Show nothing
    // 'showTableOnEmpty'=>false,
    'preHeader' => CHtml::encode($forum->title),
    'preHeaderHtmlOptions' => [
        'class' => 'preheader',
    ],
    'dataProvider' => $threadsProvider,
    'template' => $newthread . '{items}{pager}' . $newthread,
    'extraRowColumns' => ['is_sticky'],
    'extraRowExpression' => '"<b>".($data->is_sticky?"Sticky threads":"Normal threads")."</b>"',
    'columns' => $gridColumns,
    'htmlOptions' => [
        'class' => Yii::app()->controller->module->forumTableClass,
    ]
]);

