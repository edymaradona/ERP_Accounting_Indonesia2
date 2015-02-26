<?php
$this->breadcrumbs = [
    'Applicant' => ['index'],
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

$this->menu10 = [
    ['label' => 'Vacancy', 'icon' => 'home', 'url' => ['/m1/hVacancy']],
    ['label' => 'Applicant', 'icon' => 'user', 'url' => ['/m1/hApplicant']],
    ['label' => 'Selection Registration', 'icon' => 'tint', 'url' => ['/m1/jSelection']],
    ['label' => 'Interview', 'icon' => 'volume-up', 'url' => ['/m1/hVacancy/interview']],
];
?>

<?php $this->beginContent('/layouts/column1N'); ?>


    <div class="page-header">
        <h1>
            <i class="fa fa-paperclip fa-fw"></i>
            Applicant Interview Status
        </h1>
    </div>

<?php foreach ($dataProvider->getData() as $data) { ?>
    <div class="row">
        <div class="col-md-12">
            <h4 style="padding-bottom:4px;border: 1px grey;border-bottom-style: solid;">
                <?php
                echo CHtml::link($data->applicant->applicant_name, Yii::app()->createUrl('/m1/hApplicant/view', ['id' => $data->applicant_id])) . " -> " .
                    CHtml::link($data->vacancy->vacancy_title . " | " . $data->vacancy->company->name, Yii::app()->createUrl('/m1/hVacancy/interviewDetail', ['id' => $data->id]));
                ?>

            </h4>

            <?php
            $form = $this->beginWidget('CActiveForm', [
                'id' => 'form-' . $data->id,
                'enableAjaxValidation' => false,
                'action' => ($this->id == "interview") ? ['/m1/hVacancy/interview', 'id' => $data->id] :
                        ['/m1/hVacancy/interviewDetail', 'id' => $data->id],
            ]);
            ?>
            <?php echo CHtml::activeTextArea($model, 'comment', ['rows' => 5, 'class' => 'col-md-12']); ?>

            <?php
            $this->widget('zii.widgets.jui.CJuiButton', [
                'buttonType' => 'submit',
                'name' => 'btnShare-' . $data->id,
                'caption' => 'Comment',
                'options' => ['icons' => 'js:{secondary:"ui-fa fa-extlink"}'],
            ]);
            ?>

            <?php $this->endWidget(); ?>
            <?php foreach ($data->comment as $comment) { ?>
                <div class="row" style="margin-bottom:10px">
                    <div class="col-md-1">
                        <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/nophoto.jpg", 'No Photo', ["width" => "100%", 'id' => 'photo']); ?>
                    </div>
                    <div class="col-md-5">
                        <b><?php echo sUser::model()->findName((int)$comment->user_id); ?></b>

                        <div style="color:grey;float:right;">
                            <?php echo peterFunc::nicetime($comment->created_date); ?><br/>
                        </div>
                        <div style="float:none;">
                            <?php echo $comment->comment; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>


        </div>
    </div>
    <br/>
<?php } ?>

<?php
$this->endContent();
