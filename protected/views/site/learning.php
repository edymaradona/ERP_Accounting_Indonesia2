<?php
/* @var $this ILearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Learning Schedule',
];
?>

<div class="row">
    <div class="col-md-8">
        <div class="page-header">
            <h1>
                <i class="fa fa-book fa-fw"></i>
                Learning Schedule
            </h1>
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
                    'center' => 'title',
                    'right' => 'today'
                ],
                //'lazyFetching'=>true,
                'events' => Yii::app()->createUrl('/site/calendarEvents'), // action URL for dynamic events, or
                'eventClick' => 'js:function(calEvent, jsEvent, view) {
                    $("#myModalHeader").html(calEvent.title);
                    $("#myModalBody").load("' . Yii::app()->createUrl("site/viewDetail/id") . '/"+calEvent.id+"/asModal/true");
                    $("#myModal").modal();
                }',
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

        <br/>

        <?php //$this->renderPartial("_learningPhoto", []) ?>

    </div>
    <div class="col-md-4">

        <?php $this->renderPartial("_learningPhoto", []) ?>
        <br/>
        <?php //$this->renderPartial("/site/_category", array('category_id' => 1)) ?>
        <?php $this->renderPartial("/site/_category", ['category_id' => 2]) ?>
        <?php //$this->renderPartial("/site/_category", array('category_id' => 3)) ?>
    </div>
</div>

<?php
$this->beginWidget(
    'booster.widgets.TbModal', ['id' => 'myModal']
);
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4 id="myModalHeader">Modal header</h4>
</div>

<div class="modal-body" id="myModalBody">
    <p>One fine body...</p>
</div>

<div class="modal-footer">
    <?php
    $this->widget(
        'booster.widgets.TbButton', [
            'label' => 'Close',
            'url' => '#',
            'htmlOptions' => ['data-dismiss' => 'modal'],
        ]
    );
    ?>
</div>

<?php $this->endWidget(); ?>

<?php $this->renderPartial("_tabSocNet", []) ?>

