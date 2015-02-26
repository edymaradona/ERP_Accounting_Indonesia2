<?php
echo CHtml::link('Update Profile', Yii::app()->createUrl('/m1/hApplicant/update', ["id" => $model->id]), ["class" => "btn btn-xs", "style" => "margin-bottom:10px"]);

//$this->widget('booster.widgets.TbEditableDetailView', array(
//'url' => $this->createUrl('applicant/updatePerson'),
$this->widget('ext.XDetailView', [
    'ItemColumns' => 1,
    'data' => $model,
    'attributes' => [
        //array(
        //		'header'=>'Basic Info',
        //),
        //'applicant_code',
        [
            'label' => 'Birth Place',
            'value' => $model->birth_place,
        ],
        'birth_date',
        [
            'label' => 'Sex',
            'value' => $model->sex->name,
        ],
        [
            'label' => 'Religion',
            'value' => $model->religion->name,
        ],
        //array(
        //		'label'=>'Marital Status',
        //		'value'=>$model->maritalstatus->name,
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
        [
            'name' => 'freshgrad_id',
            'value' => ($model->freshgrad_id == 1) ? "Yes" : "No",
        ],
        [
            'name' => 'expected_sallary',
            'value' => peterFunc::indoFormat($model->expected_sallary),
        ],
        //'expected_sallary',
        'expected_position',
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
    'dataProvider' => hApplicantExperience::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => [
        'style' => 'padding-top:0',
    ],
    'columns' => [
        'company_name',
        'industries',
        'start_date',
        'end_date',
        //'year_length',
        //'month_length',
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
    'dataProvider' => hApplicantEducation::model()->search($model->id),
    //'filter'=>$model,
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
    'dataProvider' => hApplicantFamily::model()->search($model->id),
    //'filter'=>$model,
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
    'dataProvider' => hApplicantEducationNf::model()->search($model->id),
    //'filter'=>$model,
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

