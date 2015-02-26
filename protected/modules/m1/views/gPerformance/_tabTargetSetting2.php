<br/>
<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'justified' => true,
            'tabs' => [
                ['id' => 'tab41a', 'label' => 'Semester I', 'content' => $this->renderPartial("_tabTargetSetting2S1", ["model" => $model, "modelPerformanceP" => $modelPerformanceP, "year" => $year], true), 'active' => true],
                ['id' => 'tab41b', 'label' => 'Full Year', 'content' => $this->renderPartial("_tabTargetSetting2S2", ["model" => $model, "modelPerformanceP" => $modelPerformanceP, "year" => $year], true)],
            ],
        ]);
        ?>
    </div>
</div>

