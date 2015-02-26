<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gMedical']],
    ['label' => 'Medical Calendar', 'icon' => 'calendar', 'url' => ['/m1/gMedical/medicalCalendar']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = [
    ['label' => 'Report to Insurance/Finance', 'icon' => 'print', 'url' => ['/m1/gMedical/weeklyReport']],
    ['label' => 'Medical Reports', 'icon' => 'print', 'url' => ['/m1/gMedical/reportByDept']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu5 = ['Medical'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gMedical/list')];

?>


<div class="page-header">
    <h1>Medical Calendar</h1>
</div>

<?php
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
            //'left' => '',
            'center' => 'title',
            'right' => 'today'
        ],
        //'lazyFetching'=>true,
        'events' => Yii::app()->createUrl('/m1/gMedical/medicalCalendarAjax'), // action URL for dynamic events, or
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
?>


