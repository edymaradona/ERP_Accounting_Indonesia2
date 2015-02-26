<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLoan']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    //array('label'=>'Manage gPerson','url'=>array('admin')),
];


//$this->menu1=gLoan::getTopUpdated();
//$this->menu2=gLoan::getTopCreated();
$this->menu5 = ['Loan'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gLoan/list')];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            Loan
        </h1>
    </div>

<?php
//$this->renderPartial('_search', [
//    'model' => $model,
//]);
?>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Waiting for Process', 'url' => Yii::app()->createUrl('/m1/gLoan')],
        ['label' => 'Outstanding', 'url' => Yii::app()->createUrl('/m1/gLoan/onOutstanding'), 'active' => true],
        ['label' => 'Paid', 'url' => Yii::app()->createUrl('/m1/gLoan/onPaid')],
    ],
    'htmlOptions' => [
    ]
]);
?>


<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => gLoan::model()->onOutstanding(),
    //'filter'=>$model,
    'columns' => [
        [
            'type' => 'raw',
            'value' => '$data->person->photoPath',
            'htmlOptions' => ["width" => "50px"],
        ],
        [
            'header' => 'Name',
            'type' => 'raw',
            'value' => function ($data) {
                    return CHtml::link($data->person->employee_name, Yii::app()->createUrl("/m1/gLoan/view", ["id" => $data->parent_id]))
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->person->mDepartment());
                },
        ],
        [
            'header' => 'Process Date',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->process_date
                    . CHtml::tag("div", ['style' => 'color:grey;font-size:12px;'], peterFunc::nicetime(strtotime($data->process_date)));
                },
        ],
        [
            'header' => 'Loan Type - Purpose',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->loan_type->name
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->purpose);
                },
        ],
        [
            'header' => 'Debit',
            'value' => 'peterFunc::indoFormat($data->debit)',
        ],
        [
            'header' => 'Credit',
            'value' => 'peterFunc::indoFormat($data->credit)',
        ],
        [
            'header' => 'Balance',
            'value' => 'peterFunc::indoFormat($data->balance)',
        ],
        /*        array(
          'class' => 'booster.widgets.TbEditableColumn',
          'name' => 'approved_amount',
          'sortable' => false,
          'editable' => array(
          'url' => $this->createUrl('/m1/gLoan/updateLoanAjax'),
          //'placement' => 'right',
          'inputclass' => 'col-md-2'
          )),
         */
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'remark',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gLoan/updateLoanAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-3'
            ]],
    ],
]);
