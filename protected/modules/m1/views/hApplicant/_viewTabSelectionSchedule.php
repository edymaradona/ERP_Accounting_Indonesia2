<?php if ($data->scheduleC != 0) { ?>
    <?php
    foreach ($data->schedule_many as $sch) {
        echo CHtml::tag('li', [], date("d-m-Y", $sch->created_date) . ", " . $sch->company->name . ", " . $sch->department->name . " - "
            . $sch->for_position . ", " . $sch->level->name);
    }
    ?>
    <br/>
<?php } ?>

