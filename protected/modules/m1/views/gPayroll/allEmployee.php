<?php
/* @var $this GPayrollController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Payroll',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPayroll']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


//$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gPayroll/list'));
?>


    <div class="page-header">
        <h1>
            <i class="fa fa-suitcase fa-fw"></i>
            All Employee | Current Periode: <?php echo peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod()) ?>
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Dash Board', 'url' => Yii::app()->createUrl('/m1/gPayroll')],
        ['label' => 'All Employee', 'url' => Yii::app()->createUrl('/m1/gPayroll/allEmployee'), 'active' => true],
        //array('label'=>'Comparison','url'=>Yii::app()->createUrl('/m1/gPayroll/previousMonth')),
    ],
    'htmlOptions' => [

    ]
]);


$this->renderPartial('_search', [
    'model' => $model,
]);

$this->widget('booster.widgets.TbGridView', [
//$this->widget('booster.widgets.TbGroupGridView', array(
//    'extraRowColumns' => array('sex_id'),
    'id' => 'g-person-grid',
    'dataProvider' => $dataProvider,
    //'filter'=>$model,
    //'template'=>'{items}',
    'type' => 'bordered condensed',
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
            //'value' => 'CHtml::link($data["employee_name"],Yii::app()->createUrl("/m1/gPayroll/view",["id"=>$data["id"]]))',
            'value' => function ($data) {
                    return CHtml::link($data["employee_name"], Yii::app()->createUrl("/m1/gPayroll/view", ["id" => $data["id"]]))
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data["department"] . " | " . $data["employee_status"]);
                }
        ],
        [
            'header' => 'Previous THP (' . gPayrollTemplate::getLastPeriod() . ')',
            'value' => 'peterFunc::indoFormat($data["previous_salary"])',
        ],
        [
            'header' => 'Current THP (' . peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod()) . ')',
            'value' => 'peterFunc::indoFormat($data["basic_salary"]+$data["t_benefit"]+$data["t_insentif"]-$data["t_deduction"])',
        ],
        [
            'header' => 'Salary (' . peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod()) . ')',
            'value' => 'peterFunc::indoFormat($data["basic_salary"])',
        ],
        [
            'header' => 'Benefit (' . peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod()) . ')',
            'value' => 'peterFunc::indoFormat($data["t_benefit"])',
        ],
        [
            'header' => 'Deduction (' . peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod()) . ')',
            'value' => 'peterFunc::indoFormat($data["t_deduction"])',
        ],
        [
            'header' => 'Insentif (' . peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod()) . ')',
            'value' => 'peterFunc::indoFormat($data["t_insentif"])',
        ],
        'remark',
    ],
]);
?>