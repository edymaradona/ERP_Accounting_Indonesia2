<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => gMedical::model()->onWaiting(),
    //'filter'=>$model,
    'enableSorting' => false,
    'template' => '{items}{pager}',
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
                    return CHtml::link($data->person->employee_name, Yii::app()->createUrl("/m1/gMedical/view", ["id" => $data->parent_id]))
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->person->mDepartment());
                },
        ],
        //'receipt_date',
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'receipt_date',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gMedical/updateAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1',
                'format' => 'dd-mm-yyyy'
            ]
        ],
        [
            'name' => 'medical_type_id',
            'value' => '$data->medical_type->name',
        ],
        /*[
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'medical_type_id',
            //we need not to set value, it will be auto-taken from source
            // 'headerHtmlOptions' => array('style' => 'width: 60px'),
            'editable' => [
                'type' => 'select',
                'url' => $this->createUrl('/m1/gMedical/updateMedicalAjax'),
                'source' => gParamMedical::medicalDropDownAll(),
            ]
        ],*/
        [
            'header' => 'Medical For, Sympthom',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->medicalForPlus
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->sympthom);
                },
        ],
        [
            'header' => 'Original Amount',
            'value' => 'peterFunc::indoFormat($data->original_amount)',
        ],
        [
            'header' => 'Superior,HR Status',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->superior_approved->name
                    . "<br/>" . $data->approved->name;
                },
        ],
        /* array(
          'class' => 'booster.widgets.TbButtonColumn',
          //'template'=>'{update}{delete}',
          'template' => '{delete}',
          //'updateButtonUrl'=>'Yii::app()->createUrl("/m1/gMedical/update",array("id"=>$data->id))',
          'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gMedical/delete",array("id"=>$data->id))',
          ), */
        [
            'class' => 'TbButtonColumn',
            'template' => '{print}{printinfo}{process}',
            'buttons' => [
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gMedical/printMedical",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:5px;',
                        'target' => '_blank',
                    ],
                ],
                'printinfo' => [
                    'label' => 'Info',
                    'url' => 'Yii::app()->createUrl("/m1/gMedical/infoMedical",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:5px;',
                        'target' => '_blank',
                    ],
                ],
                'process' => [
                    'label' => 'Process',
                    'url' => 'Yii::app()->createUrl("/m1/gMedical/process",array("id"=>$data->id,"pid"=>$data->parent_id,"type_id"=>$data->medical_type_id))',
                    'visible' => '$data->approved_id ==1',
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
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gMedical/delete",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gMedical/updateAmount',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Amount Detail',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
            //'htmlOptions'=>array(
            //    'style'=>'padding:9px 0;',
            //)
        ],
    ],
]);

