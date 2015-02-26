<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>


    <div class="page-header">
        <h1>
            <i class="fa fa-hospital-o fa-fw"></i>
            <?php echo $model->employee_name; ?>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <?php
            echo $this->renderPartial("/gMedical/_medicalBalance", ["model" => $model], true);
            ?>
        </div>
    </div>


<h4>Reimburstment</h4>


<?php
$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('start_date'),
    'id' => 'g-medical-grid',
    'dataProvider' => gMedical::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'header' => 'Receipt, Process, Settlement Date',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->receipt_date . "<br/>" .
                    $data->process_date . "<br/>" . $data->settlement_date;
                },
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
            'header' => 'Approved Amount',
            'value' => 'peterFunc::indoFormat($data->approved_amount)',
        ],
        [
            'header' => 'Balance',
            'value' => '($data->medical_type->medical_company_id == 1) ? peterFunc::indoFormat($data->balance) : "N.A."',
        ],
        [
            'header' => 'Superior,HR Status',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->superior_approved->name
                    . "<br/>" . $data->approved->name;
                },
        ],
        'remark',
        [
            'class' => 'TbButtonColumn',
            'template' => '{cupdate}{print}{printinfo}',
            'buttons' => [
                'cupdate' => [
                    'label' => 'Update',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/updateMedical",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom: 3px',
                    ],
                ],
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/printMedical",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom: 3px',
                        'target' => '_blank',
                    ],
                ],
                'printinfo' => [
                    'label' => 'Info',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/infoMedical",array("id"=>$data->id))',
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
