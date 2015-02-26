<?php

$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('process_date'),
    'id' => 'g-medical-grid',
    'dataProvider' => gMedical::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'process_date',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gMedical/updateAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1',
                'format' => 'dd-mm-yyyy'
            ]
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'settlement_date',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gMedical/updateAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1',
                'format' => 'dd-mm-yyyy'
            ]
        ],
        [
            'header' => 'Medical For',
            'value' => '$data->medicalForPlus',
        ],
        [
            'header' => 'Medical Type - Sympthom',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->medical_type->name
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->sympthom);
                },
        ],
        [
            'header' => 'Original Amount',
            'value' => 'peterFunc::indoFormat($data->original_amount)',
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'approved_amount',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gMedical/updateMedicalAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-2'
            ]
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'balance',
            'sortable' => false,
            //'visible' => '$data->medical_type->medical_company_id == 2',
            'editable' => [
                'url' => $this->createUrl('/m1/gMedical/updateMedicalAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-2'
            ]
        ],
        [
            'header' => 'Superior/ HR Status',
            'type' => 'raw',
            //'value' => '$data->superior_approved->name',
            'value' => function ($data) {
                    return $data->superior_approved->name . "<br/>" .
                    $data->approved->name;
                },
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'remark',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gMedical/updateMedicalAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-3'
            ]
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{process}{print}',
            'buttons' => [
                'process' => [
                    'label' => 'Process',
                    'url' => 'Yii::app()->createUrl("/m1/gMedical/process",array("id"=>$data->id,"pid"=>$data->person->id,"type_id"=>$data->medical_type_id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
														$.fn.yiiGridView.update("g-medical-grid", {
														data: $(this).serialize()
                                            });
                                        }',
                        ],
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:5px;',
                    ],
                ],
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gMedical/printMedical",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                    ],
                ],
            ],
        ],
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gMedical/delete",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gMedical/update',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Medical',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
    ],
]);
?>

<br/>
<h4>Insurance Usage Claim (Inter-Connect with Pan Pasific Insurance)</h4>

<?php

    $this->widget('TbGridView', [
        'id' => 'g-person-family-grid',
        'dataProvider' => gPersonFamily::model()->searchCover($model->id),
        //'filter'=>$model,
        'template' => '{items}',
        'columns' => [
            [
                'header' => 'Family Member',
                'value' => '$data["f_name"]',
            ],
            [
                'header' => 'Relation',
                'value' => '$data["relation"]',
            ],
            /*[
                'header' => 'Birth Place',
                'value' => '$data["birth_place"]',
            ],
            [
                'header' => 'Birth Date',
                'value' => 'date("d-m-Y",strtotime($data["birth_date"]))',
            ],
            [
                'header' => 'Gender',
                'value' => '$data["gender"]',
            ],*/
            'insurance_number',
            [
                'header' => 'Out Patient',
                'value' => 'MedicalComponent::panfic("usage_claim",$data["insurance_number"],"OP")',
            ],
            [
                'header' => 'In Patient',
                'value' => 'MedicalComponent::panfic("usage_claim",$data["insurance_number"],"IP")',
            ],
            [
                'header' => 'Dental',
                'value' => 'MedicalComponent::panfic("usage_claim",$data["insurance_number"],"DT")',
            ],
            [
                'header' => 'Maternity',
                'value' => 'MedicalComponent::panfic("usage_claim",$data["insurance_number"],"MT")',
            ],
        ],
    ]);

?>

<br/>
<h4>Insurance Annual Balance (Inter-Connect with Pan Pasific Insurance)</h4>

<?php

    $this->widget('TbGridView', [
        'id' => 'g-person-family-grid',
        'dataProvider' => gPersonFamily::model()->searchCover($model->id),
        //'filter'=>$model,
        'template' => '{items}',
        'columns' => [
            [
                'header' => 'Family Member',
                'value' => '$data["f_name"]',
            ],
            [
                'header' => 'Relation',
                'value' => '$data["relation"]',
            ],
            /*[
                'header' => 'Birth Place',
                'value' => '$data["birth_place"]',
            ],
            [
                'header' => 'Birth Date',
                'value' => 'date("d-m-Y",strtotime($data["birth_date"]))',
            ],
            [
                'header' => 'Gender',
                'value' => '$data["gender"]',
            ],*/
            'insurance_number',
            [
                'header' => 'Out Patient',
                'value' => 'MedicalComponent::panfic("annual_balance",$data["insurance_number"],"OP")',
            ],
            [
                'header' => 'In Patient',
                'value' => 'MedicalComponent::panfic("annual_balance",$data["insurance_number"],"IP")',
            ],
            [
                'header' => 'Dental',
                'value' => 'MedicalComponent::panfic("annual_balance",$data["insurance_number"],"DT")',
            ],
            [
                'header' => 'Maternity',
                'value' => 'MedicalComponent::panfic("annual_balance",$data["insurance_number"],"MT")',
            ],
        ],
    ]);

?>
