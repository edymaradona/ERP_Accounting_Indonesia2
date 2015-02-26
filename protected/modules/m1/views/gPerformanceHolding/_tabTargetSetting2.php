<br/>
<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'justified' => true,
            'tabs' => [
                ['id' => 'tab41a', 'label' => 'Semester I', 'content' => $this->renderPartial("/gPerformance/_tabTargetSetting2S1", ["model" => $model, "year" => $year], true), 'active' => true],
                ['id' => 'tab41b', 'label' => 'Semester II', 'content' => $this->renderPartial("/gPerformance/_tabTargetSetting2S2", ["model" => $model, "year" => $year], true)],
            ],
        ]);
        ?>
    </div>
</div>

