<div class="row">
    <div class="col-md-10">
        <?php
        $this->widget('TbGridView', [
            'id' => 'g-param-payroll-grid',
            'dataProvider' => gParamPayroll::model()->search(),
            //'filter'=>$model,
            'columns' => [
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'sort',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamPayrollAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'name',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamPayrollAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'amount',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamPayrollAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                    ]
                ],
                [
                    'class' => 'TbButtonColumn',
                    'template' => '{delete}',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gHrParameter/deleteParamPayroll",array("id"=>$data->id))',
                ],
            ],
        ]);
        ?>

        <div class="page-header">
            <h3>New Param Payroll</h3>
        </div>

        <?php
        echo $this->renderPartial('_formParamPayroll', ['model' => $model]);
        ?>

    </div>
</div>
