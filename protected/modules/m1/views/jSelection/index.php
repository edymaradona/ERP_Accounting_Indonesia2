<?php
$this->breadcrumbs = [
    'Selection' => ['index'],
];

$this->menu7 = hApplicant::model()->topRecentApplicant;

$this->menu = [
    ['label' => 'Vacancy', 'icon' => 'home', 'url' => ['/m1/hVacancy']],
    ['label' => 'Applicant', 'icon' => 'user', 'url' => ['/m1/hApplicant']],
    ['label' => 'Selection Registration', 'icon' => 'tint', 'url' => ['/m1/jSelection']],
    ['label' => 'Interview', 'icon' => 'volume-up', 'url' => ['/m1/hVacancy/interview']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-tasks fa-fw"></i>
            Selection Register
        </h1>
    </div>

<?
$this->widget('ext.EFullCalendar.EFullCalendar', [
    // polish version available, uncomment to use it
    // 'lang'=>'pl',
    // you can create your own translation by copying locale/pl.php
    // and customizing it
    // remove to use without theme
    // this is relative path to:
    // themes/<path>
    //'themeCssFile'=>'2jui-bootstrap/jquery-ui.css',
    // raw html tags
    'htmlOptions' => [
        // you can scale it down as well, try 80%
        'style' => 'width:100%'
    ],
    // FullCalendar's options.
    // Documentation available at
    // http://arshaw.com/fullcalendar/docs/
    'options' => [
        'header' => [
            'left' => 'prev,next',
            'center' => 'title',
            'right' => 'today'
        ],
        //'lazyFetching'=>true,
        'events' => Yii::app()->createUrl('/m1/jSelection/calendarEvents'), // action URL for dynamic events, or
        //'events'=>[] // pass array of events directly
        // event handling
        // mouseover for example
        //'eventMouseover'=>new CJavaScriptExpression("js:function(event, element) {
        //			element.qtip({
        //				content: event.title
        //			});
        //	 } "),
    ]
]);

