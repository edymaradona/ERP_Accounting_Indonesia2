<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>


    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            <?php echo $model->employee_name; ?>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <?php
            echo $this->renderPartial("/gLoan/_loanBalance", ["model" => $model], true);
            ?>
        </div>
    </div>


<?php
$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('start_date'),
    'id' => 'g-loan-grid',
    'dataProvider' => gLoan::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'header' => 'Process ',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->process_date;
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
        [
            'header' => 'Superior State',
            'value' => '$data->superior_approved->name',
        ],
        [
            'header' => 'HR State',
            'value' => '$data->approved->name',
        ],
        'remark',
        [
            'class' => 'TbButtonColumn',
            'template' => '{cupdate}',
            'buttons' => [
                'cupdate' => [
                    'label' => 'Update',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/updateLoan",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                    ],
                ],
            ],
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{print}',
            'buttons' => [
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/printLoan",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'target' => '_blank',
                    ],
                ],
            ],
        ],
    ],
]);

