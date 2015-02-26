<?php
/* @var $this GPayrollController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Home Payroll',
];

$this->menu = [
    //array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gPayroll')),
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


//$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gPayroll/list'));
?>


    <div class="page-header">
        <h1>
            <i class="fa fa-suitcase fa-fw"></i>
            Payroll | Current Periode: <?php echo peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod()) ?>
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Dash Board', 'url' => Yii::app()->createUrl('/m1/gPayroll'), 'active' => true],
        ['label' => 'All Employee', 'url' => Yii::app()->createUrl('/m1/gPayroll/allEmployee')],
        //array('label'=>'Comparison','url'=>Yii::app()->createUrl('/m1/gPayroll/previousMonth')),
    ],
    'htmlOptions' => [

    ]
]);
?>

    <br/>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'link',
                'url' => Yii::app()->createUrl('m1/gPayroll/payrollChange'),
                //'context' => 'primary',
                'icon' => 'fa fa-check',
                'label' => 'Salary Change Report',
            ]);
            ?>
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'link',
                'url' => Yii::app()->createUrl('m1/gPayroll/fullConfirm'),
                //'context' => 'primary',
                'icon' => 'fa fa-check',
                'label' => 'Full Confirm',
            ]);
            ?>
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'link',
                //'context' => 'primary',
                'url' => Yii::app()->createUrl('m1/gPayroll/payrollAllEmployee'),
                'icon' => 'fa fa-check',
                'label' => 'Report All Employee',
            ]);
            ?>
        </div>
    </div>

    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <ul class="nav nav-list">
            <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Payroll Changing
            </li>
        </ul>
    </div>


<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => $dataProvider,
    //'filter'=>$model,
    'template' => '{items}{summary}',
    'htmlOptions' => ["style" => "padding-top:0px"],
    'columns' => [
        //array(
        //	'type'=>'raw',
        //	'value'=>'$data->photoPath',
        //	'htmlOptions'=>array("width"=>"50px"),
        //),
        [
            'header' => 'Name',
            'type' => 'raw',
            'value' => function ($data) {
                    return CHtml::link($data["employee_name"], Yii::app()->createUrl("/m1/gPayroll/view", ["id" => $data["id"]]))
                    . CHtml::tag("div", ["style" => "font-size:11px"], $data["department"])
                    . CHtml::tag("div", ["style" => "font-size:11px"], $data["employee_status"])
                    . CHtml::tag("div", ["style" => "font-size:11px"], 'Join Date: ' . date("d-m-Y", strtotime($data["join_date"])));
                },
        ],
        [
            'header' => 'Category',
            'type' => 'raw',
            'value' => '$data["Category"]',
        ],
        /*        array(
          'header' => 'Previous Salary',
          'value' => 'peterFunc::indoFormat($data->mBasicSalary)',
          ),
         */
        [
            'header' => 'Component',
            //'value' => '$data->mDepartment()',
            'type' => 'raw',
            'value' => function ($data) {
                    return "Basic Salary" . "<br/>"
                    . "Benefit" . "<br/>"
                    . "Deduction" . "<br/>"
                    . "Insentif";
                },
            'htmlOptions' => [
                'style' => 'width:100px;'
            ]
        ],
        [
            'header' => 'Period',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data["Periode"] . "<br/>"
                    . $data["Periode_benefit"] . "<br/>"
                    . $data["Periode_deduction"] . "<br/>"
                    . $data["Periode_insentif"] . "<br/>";
                },
            'htmlOptions' => [
                'style' => 'text-align: right;margin-right:2px;'
            ]
        ],
        [
            'header' => 'Previous',
            'type' => 'raw',
            'value' => function ($data) {
                    return peterFunc::indoFormat($data["basic_salary_previous"]) . "<br/>"
                    . peterFunc::indoFormat($data["t_benefit_previous"]) . "<br/>"
                    . peterFunc::indoFormat($data["t_deduction_previous"] * -1) . "<br/>";
                },
            'htmlOptions' => [
                'style' => 'text-align: right;margin-right:2px;'
            ]
        ],
        [
            'header' => 'Current',
            'type' => 'raw',
            'value' => function ($data) {
                    return peterFunc::indoFormat($data["basic_salary"]) . "<br/>"
                    . peterFunc::indoFormat($data["t_benefit"]) . "<br/>"
                    . peterFunc::indoFormat($data["t_deduction"] * -1) . "<br/>"
                    . peterFunc::indoFormat($data["t_insentif"]);
                },
            'htmlOptions' => [
                'style' => 'text-align: right;margin-right:2px;'
            ]
        ],
        [
            'header' => 'Prorate',
            'type' => 'raw',
            'value' => function ($data) {
                    return peterFunc::indoFormat($data["Prorate_salary"]) . "<br/>"
                    . peterFunc::indoFormat($data["t_benefit_prorate"]) . "<br/>"
                    . peterFunc::indoFormat($data["t_deduction_prorate"] * -1) . "<br/>";
                },
            'htmlOptions' => [
                'style' => 'text-align: right;margin-right:2px;'
            ]
        ],
        'remark',
        [
            'class' => 'TbButtonColumn',
            'template' => '{create}{confirm}',
            'buttons' => [
                'create' => [
                    'label' => 'Create',
                    //'icon' => 'icon-ok-circle',
                    'url' => 'Yii::app()->createUrl("/m1/gPayroll/view",array("id"=>$data["id"]))',
                    'visible' => '$data["confirm_id"] == null',
                    'options' => [
                        'class' => 'btn btn-primary btn-xs',
                    ],
                ],
                'confirm' => [
                    'label' => 'Confirm',
                    //'icon' => 'icon-ok-circle',
                    'url' => 'Yii::app()->createUrl("/m1/gPayroll/confirm",array("id"=>$data["pid"]))',
                    'visible' => '$data["confirm_id"] == 1  || $data["Confirm_benefit_id"] == 1 
                    || $data["Confirm_deduction_id"] == 1 || $data["Confirm_insentif_id"] == 1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
                                $.fn.yiiGridView.update("g-person-grid", {
                                    data: $(this).serialize()
                                });
                            }',
                        ],
                        'class' => 'btn btn-primary btn-xs',
                    ],
                ],
            ],
        ],
        [
            'header' => 'Status',
            'type' => 'raw',
            //'value' => '($data["confirm_id"] == 2) ? CHtml::tag("span",array("class"=>"label label-success"),"Confirmed") : 
            //    CHtml::tag("span",array("class"=>"label label-warning"),"Unprocess") ',
            'value' => function ($data) {
                    return ($data["confirm_id"] == null || $data["confirm_id"] == 1 || $data["Confirm_benefit_id"] == 1 || $data["Confirm_deduction_id"] == 1 || $data["Confirm_insentif_id"] == 1) ?
                        CHtml::tag("span", ["class" => "label label-warning"], "Unprocess") :
                        CHtml::tag("span", ["class" => "label label-success"], "Confirmed");
                },
        ],
    ],
]);
?>

    <br/>

    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <ul class="nav nav-list">
            <li class="nav-header"><i class="fa fa-bars fa-fw"></i>New Mutation
            </li>
        </ul>
    </div>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-newemployee-grid',
    'dataProvider' => gPerson::model()->newMutation,
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => ["style" => "padding-top:0px"],
    'columns' => [
        //array(
        //      'type'=>'raw',
        //      'value'=>'$data->photoPath',
        //      'htmlOptions'=>array("width"=>"50px"),
        //),
        [
            'header' => 'Name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPayroll/view",array("id"=>$data->id)))',
        ],
        [
            'header' => 'Department',
            'value' => '$data->mDepartment()',
        ],
        [
            'header' => 'Join Date',
            'value' => '$data->companyfirst->start_date',
        ],
        /*        array(
          'header' => 'Basic Salary',
          'value' => 'peterFunc::indoFormat($data->mBasicSalary)',
          ),
          array(
          'header' => 'Benefit',
          'value' => 'peterFunc::indoFormat($data->benefitC)',
          ),
          array(
          'header' => 'Deduction',
          'value' => 'peterFunc::indoFormat($data->deductionC)',
          ),
         */
        'remark',
        /* array(
          'header' => 'Status',
          'type' => 'raw',
          'value' => '(isset($data->payroll->id)) ? CHtml::tag("span",array("class"=>"label label-success"),"Process") :
          CHtml::tag("span",array("class"=>"label label-warning"),"Unprocess") ',
          ), */
    ],
]);
?>

    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <ul class="nav nav-list">
            <li class="nav-header"><i class="fa fa-bars fa-fw"></i>New Promotion
            </li>
        </ul>
    </div>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-newemployee-grid',
    'dataProvider' => gPerson::model()->newPromotion,
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => ["style" => "padding-top:0px"],
    'columns' => [
        //array(
        //      'type'=>'raw',
        //      'value'=>'$data->photoPath',
        //      'htmlOptions'=>array("width"=>"50px"),
        //),
        [
            'header' => 'Name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPayroll/view",array("id"=>$data->id)))',
        ],
        [
            'header' => 'Department',
            'value' => '$data->mDepartment()',
        ],
        [
            'header' => 'Join Date',
            'value' => '$data->companyfirst->start_date',
        ],
        /*        array(
          'header' => 'Basic Salary',
          'value' => 'peterFunc::indoFormat($data->mBasicSalary)',
          ),
          array(
          'header' => 'Benefit',
          'value' => 'peterFunc::indoFormat($data->benefitC)',
          ),
          array(
          'header' => 'Deduction',
          'value' => 'peterFunc::indoFormat($data->deductionC)',
          ),
         */
        'remark',
        /* array(
          'header' => 'Status',
          'type' => 'raw',
          'value' => '((isset($data->payroll)) && $data->payroll->category_id == 2) ? CHtml::tag("span",array("class"=>"label label-success"),"Process") :
          CHtml::tag("span",array("class"=>"label label-warning"),"Unprocess") ',
          ), */
    ],
]);
?>

    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <ul class="nav nav-list">
            <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Recent Resign
            </li>
        </ul>
    </div>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-newemployee-grid',
    'dataProvider' => gPerson::model()->newResign,
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => ["style" => "padding-top:0px"],
    'columns' => [
        //array(
        //      'type'=>'raw',
        //      'value'=>'$data->photoPath',
        //      'htmlOptions'=>array("width"=>"50px"),
        //),
        [
            'header' => 'Name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPayroll/view",array("id"=>$data->id)))',
        ],
        [
            'header' => 'Department',
            'value' => '$data->mDepartment()',
        ],
        /* array(
          'header' => 'Category',
          'type' =>'raw',
          'value' => '(isset($data->payroll)) ? $data->payroll->category->name ." <br/> effective per " .$data->payroll->yearmonth_start : ""',
          ), */
        [
            'header' => 'Resign Date',
            'value' => '$data->status->start_date',
        ],
        /*        array(
          'header' => 'Basic Salary',
          'value' => 'peterFunc::indoFormat($data->mBasicSalary)',
          ),
          array(
          'header' => 'Benefit',
          'value' => 'peterFunc::indoFormat($data->benefitC)',
          ),
          array(
          'header' => 'Deduction',
          'value' => 'peterFunc::indoFormat($data->deductionC)',
          ),
         */
        'remark',
        /*        array(
          'header' => 'Status',
          'type' => 'raw',
          'value' => '(isset($data->payroll) && $data->payroll->category_id ==9) ? CHtml::tag("span",array("class"=>"label label-success"),"Process") :
          CHtml::tag("span",array("class"=>"label label-warning"),"Unprocess") ',
          ), */
    ],
]);

