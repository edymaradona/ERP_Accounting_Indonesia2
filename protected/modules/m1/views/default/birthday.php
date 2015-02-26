<?php
$this->breadcrumbs = [
    $this->module->id,
];
?>

<div class="row">
    <div class="col-md-2">
        <?php echo $this->renderPartial('_menuNavigation'); ?>
    </div>

    <div class="col-md-10">
        <div class="page-header">
            <h1>Birthday</h1>
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
                'events' => Yii::app()->createUrl('/m1/default/calendarEvents'), // action URL for dynamic events, or
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
    </div>
</div>


