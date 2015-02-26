<div style="font-size:11px">Data Completeness <span
        class="pull-right strong"><?php echo peterFunc::indoFormat($data->completion) ?>%</span>
    <?php
    $this->widget('booster.widgets.TbProgress', [
        'context' => 'success', // 'info', 'success' or 'danger'
        'percent' => $data->completion,
        'htmlOptions' => [
            'style' => 'height:7px',
        ]
    ]);
    ?>
</div>

