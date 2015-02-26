<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLoan']],
    ['icon' => 'calendar', 'label' => 'Loan Calendar', 'url' => ['/m1/gLoan/loanCalendar']],
];

$this->menu1 = [
    //array('icon' => 'print', 'label' => 'Loan Reports ', 'url' => array('/m1/gLoan/reportByDept')),
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu5 = ['Loan'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gLoan/list')];

?>


<div class="page-header">
    <h1>Loan Calendar</h1>
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
        'events' => Yii::app()->createUrl('/m1/gLoan/loanCalendarAjax'), // action URL for dynamic events, or
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


