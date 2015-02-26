<?php if (Yii::app()->request->getParam("tab") != null): ?>

    <script>

        $(document).ready(function () {
            $('#tabs a:contains("<?php echo Yii::app()->request->getParam("tab"); ?>")').tab('show');
        });

    </script>

<?php endif; ?>


<?php
/* @var $this GPayrollController */
/* @var $model gPayroll */

$this->breadcrumbs = [
    'Home Payroll' => ['/m1/gPayroll'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPayroll']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

<div class="page-header">
    <h1><?php echo $model->employee_name; ?></h1>
</div>

<?php
$this->widget(
    'booster.widgets.TbGridView', [
        'dataProvider' => gPayrollTemplate::getYearHistory($model->id),
        'template' => "{items}",
        'enableSorting' => false,
        'columns' => [
            ['name' => 'type', 'header' => 'Type'],
            [
                'value' => 'peterFunc::indoFormat($data["jan"])',
                'header' => 'Jan ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '01']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["feb"])',
                'header' => 'Feb ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '02']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["mar"])',
                'header' => 'Mar ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '03']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["apr"])',
                'header' => 'Apr ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '04']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["mei"])',
                'header' => 'May ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '05']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["jun"])',
                'header' => 'Jun ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '06']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["jul"])',
                'header' => 'Jul ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '07']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["agt"])',
                'header' => 'Aug ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '08']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["sep"])',
                'header' => 'Sep ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '09']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["okt"])',
                'header' => 'Oct ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '10']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["nov"])',
                'header' => 'Nov ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '11']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
            [
                'value' => 'peterFunc::indoFormat($data["des"])',
                'header' => 'Dec ' . date("Y") . CHtml::link('Print', Yii::app()->createUrl('m1/gPayroll/print', ['id' => $model->id, 'month' => '12']), ['class' => 'btn btn-xs btn-default']),
                'htmlOptions' => [
                    'style' => 'text-align:right;margin-right:2px',
                ]
            ],
        ],
    ]
);
?>

<?php /*
  $this->widget('TbDetailView', array(
  'data' => $model,
  'attributes' => array(
  array(
  'label' => 'Basic Salary',
  'value' => (isset($model->payroll)) ? peterFunc::indoFormat($model->payroll->basic_salary): null,
  ),
  array(
  'label' => 'Total Benefit',
  'value' => (isset($model->payroll)) ? peterFunc::indoFormat($model->payroll->benefitC): null,
  ),
  array(
  'label' => 'Total Deduction',
  'value' => (isset($model->payroll)) ? peterFunc::indoFormat($model->payroll->deductionC) : null,
  ),
  ),
  )); */
?>

<br/>
<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => [
                ['id' => 'tab1', 'label' => 'Salary History', 'content' => $this->renderPartial("_tabSalary", ["model" => $model, "modelPayroll" => $modelPayroll], true), 'active' => true],
                ['id' => 'tab2', 'label' => 'Benefit', 'content' => $this->renderPartial("_tabBenefit", ["model" => $model, "modelPayrollBenefit" => $modelPayrollBenefit], true)],
                ['id' => 'tab3', 'label' => 'Insentif', 'content' => $this->renderPartial("_tabInsentif", ["model" => $model, "modelPayrollInsentif" => $modelPayrollInsentif], true)],
                ['id' => 'tab4', 'label' => 'Deduction', 'content' => $this->renderPartial("_tabDeduction", ["model" => $model, "modelPayrollDeduction" => $modelPayrollDeduction], true)],
                //['id' => 'tab5', 'label' => 'Jamsostek', 'content' => $this->renderPartial("_tabJamsostek", ["model" => $model], true)],
                ['id' => 'tab6', 'label' => 'Profile', 'content' => $this->renderPartial("/gPerson/_personalInfo2", ["model" => $model], true)],
            ],
        ]);
        ?>
    </div>
</div>
