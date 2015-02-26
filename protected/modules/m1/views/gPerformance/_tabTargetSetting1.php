<br/>
<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'justified' => true,
            'tabs' => [
                ['id' => 'tab11a', 'label' => 'Full Year + Semester I only', 'content' => $this->renderPartial("_tabTargetSetting1S1", ["model" => $model, "modelTargetSetting" => $modelTargetSetting, "year" => $year], true), 'active' => true],
                ['id' => 'tab11b', 'label' => 'Full Year + Semester II only', 'content' => $this->renderPartial("_tabTargetSetting1S2", ["model" => $model, "modelTargetSetting" => $modelTargetSetting, "year" => $year], true)],
            ],
        ]);
        ?>
    </div>
</div>

