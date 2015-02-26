<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>


<div class="page-header">
    <h1>
        <i class="fa fa-leaf fa-fw"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'id' => 'tabs',
    'encodeLabel' => false,
    'tabs' => [
        ['id' => 'tab1', 'label' => 'Normal View', 'content' => $this->renderPartial("_attendanceNormal", ["model" => $model, 'month' => $month], true), 'active' => true],
        ['id' => 'tab2', 'label' => 'Calendar View ', 'content' => $this->renderPartial("_attendanceCalendar", ["model" => $model, 'month' => $month], true)],
    ],
]);
?>



