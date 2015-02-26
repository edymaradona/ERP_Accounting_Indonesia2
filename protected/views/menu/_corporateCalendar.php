<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-calendar fa-fw"></i><?php echo Yii::t('basic', ' Corporate Calendar') ?>
        </li>
    </ul>
</div>

<div>
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
                'center' => 'title',
                'right' => 'today'
            ],
            //'lazyFetching'=>true,
            'events' => Yii::app()->createUrl('/menu/calendarEvents'), // action URL for dynamic events, or
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
<br/>
<br/>