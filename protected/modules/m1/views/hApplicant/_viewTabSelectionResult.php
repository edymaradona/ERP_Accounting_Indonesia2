<?php if ($data->selectionC != 0) { ?>
    <?php
    foreach ($data->selection_many as $sel) {
        echo CHtml::tag('li', [], $sel->assessment_date . ", " . $sel->workflow_result_id . ", " . $sel->assessment_summary . " - "
            . $sel->development_area);
    }
    ?>
    <br/>
<?php } ?>

