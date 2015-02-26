<?php if ($data->vacancyC != 0) { ?>
    <?php
    foreach ($data->vacancyMany as $list) {
        if (in_array($list->company_id, sUser::model()->myGroupArray)) {
            echo CHtml::tag('li', [], CHtml::link($list->vacancy_title . " : " . $list->company->name, Yii::app()->createUrl('/m1/hVacancy/view', ['id' => $list->id]), ['target' => '_blank']));
        } else {
            echo CHtml::tag('li', [], $list->vacancy_title . " : " . $list->company->name);
        }
    }
    ?>
    <br/>
<?php } ?>

