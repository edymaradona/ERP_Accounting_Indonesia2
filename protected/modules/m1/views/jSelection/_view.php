<?php
/* @var $this JSelectionController */
/* @var $data jSelection */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), ['view', 'id' => $data->id]); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('pic')); ?>:</b>
    <?php echo CHtml::encode($data->pic); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
    <?php echo CHtml::encode($data->category_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('schedule_date')); ?>:</b>
    <?php echo CHtml::encode($data->schedule_date); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('additional_info')); ?>:</b>
    <?php echo CHtml::encode($data->additional_info); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('cost')); ?>:</b>
    <?php echo CHtml::encode($data->cost); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
    <?php echo CHtml::encode($data->status_id); ?>
    <br/>

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
      <?php echo CHtml::encode($data->created_date); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
      <?php echo CHtml::encode($data->created_by); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('updated_date')); ?>:</b>
      <?php echo CHtml::encode($data->updated_date); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
      <?php echo CHtml::encode($data->updated_by); ?>
      <br />

     */
    ?>

</div>