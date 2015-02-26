<section id="leaveDept">
    <div class="row">
        <div class="col-md-12">

            <div class="page-header">
                <h3>My Work Schedule</h3>
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
                        'right' => 'today, month,agendaWeek',
                    ],
                    'defaultView' => 'agendaWeek',
                    'axisFormat' => 'H:mm',
                    //'lazyFetching'=>true,
                    'events' => Yii::app()->createUrl('/m1/gEss/personalCalendarAjax'), // action URL for dynamic events, or
                    //'events'=>[] // pass array of events directly
                    // event handling
                    // mouseover for example
                    //'eventMouseover'=>new CJavaScriptExpression("js:function(event, element) {
                    //          element.qtip({
                    //              content: event.title
                    //          });
                    //   } "),
                ]
            ]);
            ?>
        </div>
    </div>
</section>