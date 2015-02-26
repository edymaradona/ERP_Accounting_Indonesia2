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
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPersonCostcenter']],
    ['label' => 'Print Profile', 'icon' => 'print', 'url' => ['printProfile', 'id' => $model->id]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();
$this->menu3 = gPerson::getTopRelated($model->employee_name);

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gPersonCostcenter/index'), 'field_name' => 'employee_name'];
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
    </div>

    <div class="col-md-9">
        <?php echo $this->renderPartial('/gPerson/_personalInfo', ['model' => $model]); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'id' => 'tabs',
            'tabs' => [
                ['id' => 'tab6', 'label' => 'Cost Center', 'content' => $this->renderPartial("_tabCostcenter", ["model" => $model, "modelCostcenter" => $modelCostcenter], true), 'active' => true],
                ['id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("/gPerson/_tabDetail", ["model" => $model], true)],
                ['id' => 'tab12', 'label' => 'Assignment', 'content' => $this->renderPartial("_tabCareer2", ["model" => $model], true)],
            ],
        ]);
        ?>
    </div>
</div>

