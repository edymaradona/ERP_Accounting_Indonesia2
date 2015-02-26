<?php if (Yii::app()->request->getParam("tab") != null): ?>

    <script>

        $(document).ready(function () {
            $('#tabs a:contains("<?php echo Yii::app()->request->getParam("tab"); ?>")').tab('show');
        });

    </script>

<?php endif; ?>

<?php
$this->breadcrumbs = [
    $this->module->id,
];
?>
<div class="page-header">
    <h1>
        <i class="fa fa-wrench fa-fw"></i>
        HR Parameter
    </h1>
</div>

<div class="row">
    <div class="col-md-12">

        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            "id" => "tabs",
            'placement' => 'left',
            'tabs' => [
                ['id' => 'tab5', 'label' => 'Level', 'content' => $this->renderPartial('_tabParamLevel', ['model' => $modelParamLevel], true), 'active' => true],
                ['id' => 'tab6', 'label' => 'Permission', 'content' => $this->renderPartial('_tabParamPermission', ['model' => $modelParamPermission], true)],
                ['id' => 'tab2', 'label' => 'Medical', 'content' => $this->renderPartial('_tabParamMedical', ['model' => $modelParamMedical], true)],
                ['id' => 'tab8', 'label' => 'Payroll', 'content' => $this->renderPartial('_tabParamPayroll', ['model' => $modelParamPayroll], true)],
                ['id' => 'tab1', 'label' => 'Selection', 'content' => $this->renderPartial('_tabParamSelection', ['model' => $modelParamSelection], true)],
            ],
        ]);
        ?>

    </div>
</div>

