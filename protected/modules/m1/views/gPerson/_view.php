<?php if (in_array($data->mStatusId(), Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY)) { ?>
<div style="background-color:#D5D5D5;padding:10px;margin:20px -11px;">
    <?php } elseif ($data->many_career2C >= 1) { ?>
    <div style="border: 1px solid #D5D5D5;padding:10px;margin:20px -11px;">
        <?php } else { ?>
        <div style="background-color:white">
            <?php } ?>

            <h3>
                <?php echo CHtml::link($data->employee_name_r, Yii::app()->createUrl($this->route . '/../view', ['id' => $data->id,])); ?>
            </h3>

            <?php echo $this->renderPartial('/gPerson/_viewDetail', ['data' => $data]); ?>

        </div>
