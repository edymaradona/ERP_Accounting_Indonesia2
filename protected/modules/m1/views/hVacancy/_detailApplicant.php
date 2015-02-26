<?php if (isset($modelApplicant)) { ?>
    <div id="display" style="padding:10px;border: 1px solid;">

    <h2>Applicant Information</h2>


    <?php
    //$this->widget('booster.widgets.TbEditableDetailView', array(
    //'url' => $this->createUrl('applicant/updatePerson'),
    $this->widget('ext.XDetailView', [
        'ItemColumns' => 1,
        'data' => $modelApplicant,
        'attributes' => [
            //array(
            //		'header'=>'Basic Info',
            //),
            [
                'label' => 'Applicant Name',
                'type' => 'raw',
                'value' => CHtml::link($modelApplicant->applicant_name, Yii::app()->createUrl('/m1/hApplicant/view', ['id' => $modelApplicant->id])),
            ],
            [
                'label' => 'Birth Place',
                'value' => $modelApplicant->birth_place,
            ],
            'birth_date',
            [
                'label' => 'Sex',
                'value' => $modelApplicant->sex->name,
            ],
            [
                'label' => 'Religion',
                'value' => $modelApplicant->religion->name,
            ],
            //array(
            //		'label'=>'Marital Status',
            //		'value'=>$modelApplicant->maritalstatus->name,
            //),
            //'blood_id',
            //array(
            //		'header'=>'Address and Domisili',
            //),
            'address1',
            /* 'address2',
              'address3',
              'pos_code', */
            //'identity_number',
            //'identity_valid',
            //'identity_address1',
            /* 'identity_address2',
              'identity_address3',
              'identity_pos_code', */
            //array(
            //		'header'=>'Contact',
            //),
            'email',
            //'email2',
            //'home_phone',
            'handphone',
            //'handphone2',
            //array(
            //		'header'=>'Bank Information',
            //),
            //'account_number',
            //'account_name',
            //'bank_name',
        ],
    ]);
    ?>

    <h3>Experience</h3>

    <?php
    $this->widget('TbGridView', [
        'id' => 'g-person-experience-grid',
        'dataProvider' => hApplicantExperience::model()->search($modelApplicant->id),
        //'filter'=>$modelApplicant,
        'template' => '{items}',
        'htmlOptions' => [
            'style' => 'padding-top:0',
        ],
        'columns' => [
            'company_name',
            'industries',
            'start_date',
            'end_date',
            'year_length',
            'month_length',
            'job_title',
            //array(
            //	'class'=>'TbButtonColumn',
            //	'template'=>'{delete}',
            //	'deleteButtonUrl'=>'Yii::app()->createUrl("applicant/deleteExperience",array("id"=>$data->id))',
            //),
            [
                //'visible'=>false,
                'class' => 'EJuiDlgsColumn',
                //'template'=>'{update}{delete}',
                'template' => '{delete}',
                'deleteButtonUrl' => 'Yii::app()->createUrl("applicant/deleteExperience",array("id"=>$data->id))',
                'updateDialog' => [
                    'controllerRoute' => 'applicant/updateExperience',
                    'actionParams' => ['id' => '$data->id'],
                    'dialogTitle' => 'Update Experience',
                    'dialogWidth' => 800, //override the value from the dialog config
                    'dialogHeight' => 530
                ],
            ],
        ],
    ]);
    ?>

    <h3>Education</h3>

    <?php
    $this->widget('booster.widgets.TbGridView', [
        'id' => 'g-education-grid',
        'dataProvider' => hApplicantEducation::model()->search($modelApplicant->id),
        //'filter'=>$modelApplicant,
        'template' => '{items}',
        'htmlOptions' => [
            'style' => 'padding-top:0',
        ],
        'columns' => [
            [
                'header' => 'Level',
                'value' => '$data->edulevel->name',
            ],
            'school_name',
            'city',
            'interest',
            'graduate',
            //'country',
            //'institution',
            'ipk',
            [
                //'visible'=>false,
                'class' => 'EJuiDlgsColumn',
                //'template'=>'{update}{delete}',
                'template' => '{delete}',
                'deleteButtonUrl' => 'Yii::app()->createUrl("applicant/deleteEducation",array("id"=>$data->id))',
                'updateDialog' => [
                    'controllerRoute' => 'applicant/updateEducation',
                    'actionParams' => ['id' => '$data->id'],
                    'dialogTitle' => 'Update Education',
                    'dialogWidth' => 800, //override the value from the dialog config
                    'dialogHeight' => 530
                ],
            ],
        ],
    ]);
    ?>

    <h3>Family</h3>

    <?php
    $this->widget('TbGridView', [
        'id' => 'g-person-family-grid',
        'dataProvider' => hApplicantFamily::model()->search($modelApplicant->id),
        //'filter'=>$modelApplicant,
        'template' => '{items}',
        'htmlOptions' => [
            'style' => 'padding-top:0',
        ],
        'columns' => [
            'f_name',
            [
                'header' => 'Relation',
                'value' => '$data->relation->name',
            ],
            'birth_place',
            'birth_date',
            [
                'header' => 'Sex',
                'value' => '$data->sex->name',
            ],
            'remark',
            //'payroll_cover_id',
            //array(
            [
                //'visible'=>false,
                'class' => 'ext.quickdlgs.EJuiDlgsColumn',
                //'template'=>'{update}{delete}',
                'template' => '{delete}',
                'deleteButtonUrl' => 'Yii::app()->createUrl("applicant/deleteFamily",array("id"=>$data->id))',
                'updateDialog' => [
                    'controllerRoute' => 'applicant/updateFamily',
                    'actionParams' => ['id' => '$data->id'],
                    'dialogTitle' => 'Update Family',
                    'dialogWidth' => 800, //override the value from the dialog config
                    'dialogHeight' => 530
                ],
            ],
        ],
    ]);
    ?>

    <h3>Non Formal Education</h3>

    <?php
    $this->widget('booster.widgets.TbGridView', [
        'id' => 'gperson-education-nf-grid',
        'dataProvider' => hApplicantEducationNf::model()->search($modelApplicant->id),
        //'filter'=>$modelApplicant,
        'template' => '{items}',
        'htmlOptions' => [
            'style' => 'padding-top:0',
        ],
        'columns' => [
            'education_name',
            'category',
            'start',
            'end',
            'sertificate:boolean',
            'country',
            [
                //'visible'=>false,
                'class' => 'EJuiDlgsColumn',
                //'template'=>'{update}{delete}',
                'template' => '{delete}',
                'deleteButtonUrl' => 'Yii::app()->createUrl("applicant/deleteEducationNf",array("id"=>$data->id))',
                'updateDialog' => [
                    'controllerRoute' => 'applicant/updateEducationNf',
                    'actionParams' => ['id' => '$data->id'],
                    'dialogTitle' => 'Update Non Formal Education',
                    'dialogWidth' => 800, //override the value from the dialog config
                    'dialogHeight' => 530
                ],
            ],
        ],
    ]);
    ?>

    <h3>Questioner</h3>
    <?php
    $modelQ = hApplicantQuestioner::model()->find('parent_id = ' . $modelApplicant->id);

    if (isset($modelQ)) {

        $this->widget('TbDetailView', [
            'data' => $modelQ,
            'attributes' => [
                'q01',
                'q02',
                'q03',
                'q04',
                'q05',
                'q06',
                'q07',
                'q08',
                'q09',
                'q10',
                'q11',
                'q12',
                'q13',
                'q14',
                'q15',
                'revisi_id',
                [
                    'label' => 'Created Date',
                    'value' => date("d-M-Y h:i", $modelQ->created_date),
                ],
                [
                    'label' => 'Updated Date',
                    'value' => date("d-M-Y h:i", $modelQ->updated_date),
                ],
            ],
        ]);
    }
    ?>

    </div>
<?php
} 