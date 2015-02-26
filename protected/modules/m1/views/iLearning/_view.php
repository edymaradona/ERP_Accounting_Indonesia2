<?php
/* @var $this ILearningController */
/* @var $data iLearning */
?>

<div class="row">
    <div class="col-md-12">
        <h4><?php echo CHtml::link(CHtml::encode($data->learning_title), ['view', 'id' => $data->id]); ?></h4>

        <b><?php echo CHtml::encode($data->getAttributeLabel('objective')); ?>:</b>
        <?php echo CHtml::encode($data->objective); ?>
        <br/>

        <b><?php echo CHtml::encode($data->getAttributeLabel('outline')); ?>:</b>
        <?php echo CHtml::encode($data->outline); ?>
        <br/>

        <b><?php echo CHtml::encode($data->getAttributeLabel('participant')); ?>:</b>
        <?php echo CHtml::encode($data->participant); ?>
        <br/>

        <b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
        <?php echo CHtml::encode($data->duration); ?>
        <br/>

        <b><?php echo CHtml::encode($data->getAttributeLabel('type_id')); ?>:</b>
        <?php echo $data->type->name; ?>
        <br/>

        <div style="background-color:#cbcbcb; padding:2px 4px; margin:5px 0">
            <strong>Schedule List:</strong>
            <?php
            foreach ($data->schedule as $list) {
                echo CHtml::link($list->schedule_date, Yii::app()->createUrl('/m1/iLearning/viewDetail', ['id' => $list->id]));
                // echo "  (" . $list->partCount . ")";
                echo " | ";
            }
            ?>
        </div>

    </div>
</div>