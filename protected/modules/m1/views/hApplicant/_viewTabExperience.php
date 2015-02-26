<br/>
<?php if ($data->many_experienceC != 0) { ?>
    <?php
    foreach ($data->many_experience as $exp) {
        echo CHtml::tag('li', [], $exp->company_name . ", " . $exp->industries . ", " . $exp->start_date . " - " . $exp->end_date
            . ", " . $exp->job_title);
    }
    ?>
    <br/>
<?php } ?>

<?php if ($data->many_educationC != 0) { ?>
    <?php
    foreach ($data->many_education as $edu) {
        echo CHtml::tag('li', [], $edu->school_name . ", " . $edu->city . ", " . $edu->graduate . ", " . $edu->edulevel->name
            . ", " . $edu->interest);
    }
    ?>
    <br/>
<?php } ?>

