<?php
$this->breadcrumbs = [
    'Search',
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/m1/gBiPersonHolding']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-bar-chart-o fa-fw"></i>
            Searching Holding ...
        </h1>
    </div>

<?php
echo $this->renderPartial('/gBiPerson/_mainContent', ["model" => $model, "dataProvider" => $dataProvider, 'field' => $field, 'production' => $production, 'sql' => $sql]);
?>