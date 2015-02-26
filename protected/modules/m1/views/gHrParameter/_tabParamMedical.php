<div class="row">
    <div class="col-md-10">
        <?php
        $this->widget('TbGridView', [
            'id' => 'g-param-medical-grid',
            'dataProvider' => gParamMedical::model()->search(),
            //'filter'=>$model,
            'columns' => [
                'id',
                'parent_id',
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'sort',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/UpdateParamMedicalAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                        'title' => 'Sort',
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'name',
                    'value' => '($data->parent_id ==0) ? $data->name : "-- ".$data->name',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/UpdateParamMedicalAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'level_id',
                    //we need not to set value, it will be auto-taken from source
                    // 'headerHtmlOptions' => array('style' => 'width: 60px'),
                    'editable' => [
                        'type' => 'select',
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamMedicalAjax'),
                        'source' => gParamLevel::levelDropDownParent('.:ALL LEVEL:.'),
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'medical_company_id',
                    //we need not to set value, it will be auto-taken from source
                    // 'headerHtmlOptions' => array('style' => 'width: 60px'),
                    'editable' => [
                        'type' => 'select',
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamMedicalAjax'),
                        'source' => ['1' => 'Internal', '2' => 'Insurance Company'],
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'yearmonth_start',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/UpdateParamMedicalAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                        'title' => 'Year Month Start',
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'amount',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/UpdateParamMedicalAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                        'title' => 'Amount',
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'formula',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/UpdateParamMedicalAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                        'title' => 'Formula',
                    ]
                ],
                [
                    'class' => 'TbButtonColumn',
                    'template' => '{delete}',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gHrParameter/deleteParamMedical",array("id"=>$data->id))',
                ],
            ],
        ]);
        ?>

        <div class="page-header">
            <h3>New Param Medical</h3>
        </div>

        <?php
        echo $this->renderPartial('_formParamMedical', ['model' => $model]);
        ?>

    </div>
</div>
