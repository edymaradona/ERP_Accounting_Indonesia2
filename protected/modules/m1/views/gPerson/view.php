<?php if (Yii::app()->request->getParam("tab") != null): ?>

    <script>

        $(document).ready(function () {
            $('#tabs a:contains("<?php echo Yii::app()->request->getParam("tab"); ?>")').tab('show');
        });

    </script>

<?php endif; ?>


<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    $model->id,
];


$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPerson']],
    ['label' => 'Update', 'icon' => 'edit', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Print Profile', 'icon' => 'print', 'items' => [
        ['label' => 'Print Profile Standard', 'icon' => 'plane', 'url' => ['printProfile', 'id' => $model->id]],
        ['label' => 'Print Profile With Family', 'icon' => 'hand-o-up', 'url' => ['printProfileFamily', 'id' => $model->id]],
    ]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Link to', 'icon' => 'user', 'items' => [
        ['label' => 'Link to Leave', 'icon' => 'plane', 'url' => ['/m1/gLeave/view', 'id' => $model->id]],
        ['label' => 'Link to Permission', 'icon' => 'hand-o-up', 'url' => ['/m1/gPermission/view', 'id' => $model->id]],
        ['label' => 'Link to Attendance', 'icon' => 'bell', 'url' => ['/m1/gAttendance/view', 'id' => $model->id]],
        ['label' => 'Link to Medical', 'icon' => 'hospital-o', 'url' => ['/m1/gMedical/view', 'id' => $model->id]],
        ['label' => 'Link to Performance', 'icon' => 'fire', 'url' => ['/m1/gPerformance/view', 'id' => $model->id]],
    ]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();
$this->menu3 = gPerson::getTopRelated($model->employee_name);
$this->menu5 = ['Person'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gPerson/index'), 'field_name' => 'employee_name'];

//$this->message="Testing Message";
?>

<div class="page-header">
    <h1>
        <i class="fa fa-user fa-fw"></i>
        <?php echo $model->employee_name_r; ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-3">
        <?php
        echo $model->photoPath;
        ?>

        <div style="font-size:11px">Data Completeness <span
                class="pull-right strong"><?php echo number_format($model->completion, 0) ?>%</span>
            <?php
            $this->widget('booster.widgets.TbProgress', [
                'context' => 'success', // 'info', 'success' or 'danger'
                'percent' => $model->completion,
                'htmlOptions' => [
                    'style' => 'height:7px',
                ]
            ]);
            ?>
        </div>

        <div style="text-align:center; padding:10px 0">
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload', [
                'id' => 'uploadFile',
                'config' => [
                    'action' => Yii::app()->createUrl('/m1/gPerson/upload', ['id' => $model->id]),
                    'allowedExtensions' => ["jpg"], //array("jpg","jpeg","gif","exe","mov" and etc...
                    'sizeLimit' => 500 * 1024, // maximum file size in bytes
                    //'minSizeLimit'=>1*1024*1024,// minimum file size in bytes
                    'onComplete' => "js:function(id, fileName, responseJSON){ location.reload(true); }",
                    'messages' => [
                        'typeError' => "{file} has invalid extension. Only {extensions} are allowed.",
                        'sizeError' => "{file} is too large, maximum file size is {sizeLimit}.",
                        'minSizeError' => "{file} is too small, minimum file size is {minSizeLimit}.",
                        'emptyError' => "{file} is empty, please select files again without it.",
                        'onLeave' => "The files are being uploaded, if you leave now the upload will be cancelled."
                    ],
                    //'showMessage'=>"js:function(message){ alert(message); }"
                ],
            ]);
            ?>

            <?php
            //echo CHtml::link('Print Profile',Yii::app()->createUrl('/m1/gPerson/printProfile',array('id'=>$model->id)),
            //array('class'=>'btn btn-primary btn-xs','target'=>'_blank'))
            ?>
        </div>
    </div>

    <div class="col-md-9">
        <?php echo $this->renderPartial('/gPerson/_personalInfo', ['model' => $model]); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $carC = ($model->many_careerC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_careerC) : "";
        $staC = ($model->many_statusC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_statusC) : "";
        $expC = ($model->many_experienceC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_experienceC) : "";
        $eduC = ($model->many_educationC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_educationC) : "";
        $famC = ($model->many_familyC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_familyC) : "";
        $othC = ($model->many_otherC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_otherC) : "";
        $edunfC = ($model->many_educationnfC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_educationnfC) : "";
        $traC = ($model->many_trainingC != 0) ? CHtml::tag("span", ['class' => 'badge badge-info'], $model->many_trainingC) : "";

        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'id' => 'tabs',
            'encodeLabel' => false,
            'tabs' => [
                ['id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabDetail", ["model" => $model], true), 'active' => true],
                ['id' => 'tab2', 'label' => 'Career ' . $carC, 'content' => $this->renderPartial("_mainCareer", ["model" => $model, "modelCareer" => $modelCareer], true)],
                ['id' => 'tab3', 'label' => 'Status ' . $staC, 'content' => $this->renderPartial("_mainStatus", ["model" => $model, "modelStatus" => $modelStatus], true)],
                ['id' => 'tab4', 'label' => 'Experience ' . $expC, 'content' => $this->renderPartial("_mainExperience", ["model" => $model, "modelExperience" => $modelExperience], true)],
                ['id' => 'tab5', 'label' => 'Education ' . $eduC, 'content' => $this->renderPartial("_mainEducation", ["model" => $model, "modelEducation" => $modelEducation], true)],
                ['id' => 'tab8', 'label' => 'Training ' . $traC, 'content' => $this->renderPartial("_mainTraining", ["model" => $model, "modelTraining" => $modelTraining], true)],
                ['id' => 'tab9', 'label' => 'Family ' . $famC, 'content' => $this->renderPartial("_mainFamily", ["model" => $model, "modelFamily" => $modelFamily], true)],
                ['id' => 'tab7', 'label' => 'More...', 'items' => [
                    ['id' => 'tab10', 'label' => 'Non Formal Edu ' . $edunfC, 'content' => $this->renderPartial("_mainEducationNf", ["model" => $model, "modelEducationNf" => $modelEducationNf], true)],
                    ['id' => 'tab11', 'label' => 'Other Info ' . $othC, 'content' => $this->renderPartial("_mainOther", ["model" => $model, "modelOther" => $modelOther], true)],
                    //array('id'=>'tab6','label'=>'Cost Center','content'=>$this->renderPartial("_mainCostcenter", array("model"=>$model,"modelCostcenter"=>$modelCostcenter), true)),
                    ['id' => 'tab12', 'label' => 'Assignment', 'content' => $this->renderPartial("_tabCareer2", ["model" => $model, "modelCareer2" => $modelCareer2], true)],
                    ['id' => 'tab13', 'label' => 'SSO', 'content' => $this->renderPartial("_tabSso", ["model" => $model], true)],
                ]],
            ],
        ]);
        ?>
    </div>
</div>

<?php $this->renderPartial('_sameDepartment', ['model' => $model]); ?>
