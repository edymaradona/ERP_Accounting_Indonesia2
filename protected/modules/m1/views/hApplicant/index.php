<?php
$this->breadcrumbs = [
    'Applicant' => ['index'],
];

$this->menu5 = ['Applicant'];
//$this->menu7 = hApplicant::model()->topRecentApplicant;
$this->menu11 = hApplicantExperience::getJobTitleCloud();


$this->menu = [
    ['label' => 'Vacancy', 'icon' => 'home', 'url' => ['/m1/hVacancy']],
    ['label' => 'Applicant', 'icon' => 'user', 'url' => ['/m1/hApplicant']],
    ['label' => 'Selection Registration', 'icon' => 'tint', 'url' => ['/m1/jSelection']],
    ['label' => 'Interview', 'icon' => 'volume-up', 'url' => ['/m1/hVacancy/interview']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
    $.fn.yiiListView.update('applicantList', { 
        data: $(this).serialize()
    });
    return false;
});


");
?>

<?php $this->beginContent('//layouts/column1N'); ?>


    <div class="page-header">
        <h1>
            <i class="fa fa-copy fa-fw"></i>
            Applicant
        </h1>
    </div>

<?php
//	Yii::app()->user->setFlash('info', '<strong>Good News!</strong> Saat ini, Pendaftaran Registrasi peserta Assessment, tidak perlu lagi diinput ke database Applicant.
//	 Anda bisa langsung ke Selection Registration, pilih tanggal assessment dan masukan daftar karyawan di business unit masing-masing yang akan di assessment. 
//	 Mekanisme pendaftaran peserta psikotes tidak berubah... ');
?>


<?php
echo $this->renderPartial('_search', ['model' => $model]);
?>
<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'id' => 'applicantList',
    'itemView' => '_view',
]);
?>

<?php
$this->endContent();
