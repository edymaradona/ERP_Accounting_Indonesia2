<?php

$this->breadcrumbs = [
    'G Vacancies' => ['index'],
];

$this->menu7 = hVacancy::model()->topRecentVacancy;

$this->menu = [
    ['label' => 'Vacancy', 'icon' => 'home', 'url' => ['/m1/hVacancy']],
    ['label' => 'Applicant', 'icon' => 'user', 'url' => ['/m1/hApplicant']],
    ['label' => 'Selection Registration', 'icon' => 'tint', 'url' => ['/m1/jSelection']],
    ['label' => 'Interview', 'icon' => 'volume-up', 'url' => ['/m1/hVacancy/interview']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
$this->menu4 = hVacancyApplicant::model()->topRecentInterview;
$this->menu8 = hApplicant::model()->topRecentApplicant;
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-paperclip fa-fw"></i>
            Email Invitation
        </h1>
    </div>


<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'email-form',
    //'type'=>'horizontal',
    'enableAjaxValidation' => true,
]);
?>

<?php echo $form->textFieldGroup($model, 'email'); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'datetime', ['class' => 'col-sm-3 control-label']); ?>
        <div class="col-sm-9">
            <?php
            $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                    'model' => $model,
                    'attribute' => 'datetime',
                    'options' => [
                        'dateFormat' => 'dd-mm-yy',
                        'timeFormat' => 'hh:mm', //'hh:mm tt' default
                        'defaultValue' => (isset($model->cdate)) ? date('d-m-Y', strtotime($model->cdate)) : date('d-m-Y h:i'),
                        //'minDate' => ($model->cdate !=null) ? date('d-m-Y',strtotime($model->cdate)) : date('d-m-Y',strtotime('01-'.date("m-Y"))),
                        //'maxDate' => ($model->cdate !=null) ? date('d-m-Y',strtotime($model->cdate."1 day")) :
                        //		date('d-m-Y',strtotime('01-'.date("m-Y",strtotime(date("d-m-Y")."1 month"))."-1 day")),
                    ],
                ]
            );
            ?>
        </div>
    </div>

<?php echo $form->textAreaGroup($model, 'place', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>

<?php echo $form->textFieldGroup($model, 'pic'); ?>

    <div class="form-group">
        <?php echo CHtml::htmlButton('<i class="fa fa-check fa-fw"></i>Send Email', ['class' => 'btn', 'type' => 'submit']); ?>
    </div>

<?php
$this->endWidget();

