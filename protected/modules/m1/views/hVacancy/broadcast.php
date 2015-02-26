<?php
$this->breadcrumbs = [
    'broadcast' => ['broadcast'],
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
    <h1>Broadcast: <?php echo $modelVacancy->vacancytitle ?></h1>
</div>

<div class="raw">
    <div class="col-md-10">
        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'c-form',
            'enableAjaxValidation' => false,
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textAreaGroup($model, 'receiver', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>

        <?php echo $form->textFieldGroup($model, 'subject'); ?>

        <?php //echo $form->textAreaGroup($model,'body',array('class'=>'col-md-7', 'rows'=>25));  ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'body', ['class' => 'col-sm-3 control-label']); ?>
            <div class="col-sm-9">
                <?php
                $this->widget('ext.tinymce.TinyMce', [
                    'model' => $model,
                    'attribute' => 'body',
                    // Optional config
                    'compressorRoute' => 'sCompanyNews/compressor',
                    'spellcheckerRoute' => 'sCompanyNews/spellchecker',
                    //'fileManager' => array(
                    //	'class' => 'ext.elFinder.TinyMceElFinder',
                    //	'connectorRoute'=>'sFileBrowser/connectorPublicFolder',
                    //),
                    //'htmlOptions' => array(
                    //	'rows' => 6,
                    //	'cols' => '100%',
                    //),
                ]);
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo CHtml::htmlButton('<i class="fa fa-check fa-fw"></i>Submit', ['class' => 'btn', 'type' => 'submit']); ?>
        </div>
        <?php //echo CHtml::submitButton('Submit');  ?>

        <?php $this->endWidget(); ?>


    </div>
</div>
