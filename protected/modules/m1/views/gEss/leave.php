<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>


<div class="page-header">
    <h1>
        <i class="fa fa-plane fa-fw"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>


<div class="row">
    <div class="col-md-12">

        <?php
        echo $this->renderPartial("/gLeave/_leaveBalance", ["model" => $model], true);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbGridView', [
            'id' => 'g-person-grid',
            'dataProvider' => gLeave::model()->search($model->id),
            //'filter'=>$model,
            'template' => '{items}',
            //'rowCssClassExpression' => '$data->cssReason()',
            'rowCssClassExpression' => '
        		( $row%2 ? $this->rowCssClass[1] : $this->rowCssClass[0] ) .
        		( ($data->leave_reason == "Auto Generated Leave") ? " info" : "" )
    		',
            'columns' => [
                [
                    'name' => 'start_date',
                    'htmlOptions' => [
                        'style' => 'width:100px',
                    ],
                    'type' => 'raw',
                    'value' => function ($data) {
                            return
                                $data->start_date
                                . CHtml::tag('div', ['style' => 'font-size: 11px;'], date('l', strtotime($data->start_date)));
                        }
                ],
                [
                    'name' => 'end_date',
                    'htmlOptions' => [
                        'style' => 'width:100px',
                    ],
                    'type' => 'raw',
                    'value' => function ($data) {
                            return
                                $data->end_date
                                . CHtml::tag('div', ['style' => 'font-size: 11px;'], date('l', strtotime($data->end_date)));
                        }
                ],
                'number_of_day',
                //'work_date',
                [
                    'name' => 'leave_reason',
                    'htmlOptions' => [
                        //'style'=>'width:250px',
                    ]
                ],
                //'leave_reason',
                //'mass_leave',
                //'person_leave',
                'balance',
                //'replacement',
                [
                    'header' => 'Superior/ HR Status',
                    'type' => 'raw',
                    //'value' => '$data->superior_approved->name',
                    'value' => function ($data) {
                            return $data->superior_approved->name . " "  . "<br/>" .
                            $data->approved->name ;
                        },
                ],
                /*[
                    'header' => 'Superior State',
                    'value' => '$data->superior_approved->name',
                    'htmlOptions' => [
                        'style' => 'width:150px',
                    ],
                    'cssClassExpression' => '
						( ($data->superior_approved_id == 2) ? "green" : "white" )
					',
                ],
                [
                    'header' => 'HR State',
                    'value' => '$data->approved->name',
                    'htmlOptions' => [
                        'style' => 'width:150px;',
                    ],
                    'cssClassExpression' => '
						( ($data->approved_id == 2) ? "green" : "white" )
					',
                ],*/
                [
                    'class' => 'TbButtonColumn',
                    'template' => '{mydelete}',
                    'buttons' => [
                        'mydelete' => [
                            'label' => 'Delete',
                            //'icon'=>'fa fa-delete',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/deleteLeave",array("id"=>$data->id))',
                            'visible' => '$data->balance == null && strtotime($data->start_date) > time()',
                            'options' => [
                                'class' => 'btn btn-xs btn-default',
                            ],
                        ],
                    ],
                ],
                [
                    'class' => 'TbButtonColumn',
                    'template' => '{cupdate}{cupdatecancel}',
                    'buttons' => [
                        'cupdate' => [
                            'label' => 'Update',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/updateLeave",array("id"=>$data->id))',
                            'visible' => '$data->approved_id ==1 && strtotime($data->start_date) > time()',
                            'options' => [
                                'class' => 'btn btn-xs btn-default',
                            ],
                        ],
                        'cupdatecancel' => [
                            'label' => 'Update',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/updateCancellationLeave",array("id"=>$data->id))',
                            'visible' => '$data->approved_id ==8 && $data->balance ==null && strtotime($data->start_date) > time()',
                            'options' => [
                                'class' => 'btn btn-xs btn-default',
                            ],
                        ],
                    ],
                ],
                [
                    'class' => 'TbButtonColumn',
                    'template' => '{print}{printswitchover}{printextended}',
                    'buttons' => [
                        'print' => [
                            'label' => 'Print',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/printLeave",array("id"=>$data->id))',
                            'visible' => '$data->approved_id ==1',
                            'options' => [
                                'class' => 'btn btn-xs btn-default',
                                'target' => '_blank',
                            ],
                        ],
                        'printswitchover' => [
                            'label' => 'Print',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/printSwitchoverLeave",array("id"=>$data->id))',
                            'visible' => '$data->approved_id ==6 AND $data->balance ==null',
                            'options' => [
                                'class' => 'btn btn-xs btn-default',
                                'target' => '_blank',
                            ],
                        ],
                        'printextended' => [
                            'label' => 'Print',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/printExtendedLeave",array("id"=>$data->id))',
                            'visible' => '$data->approved_id ==5',
                            'options' => [
                                'class' => 'btn btn-xs btn-default',
                                'target' => '_blank',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        ?>
    </div>
</div>

<section id="leaveDept">
    <div class="row">
        <div class="col-md-12">

            <div class="page-header">
                <h3>Department Leave Calendar</h3>
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
                    'events' => Yii::app()->createUrl('/m1/gEss/departmentCalendarAjax', ['id' => $model->mDepartmentId()]), // action URL for dynamic events, or
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
</section>


