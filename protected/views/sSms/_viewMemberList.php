<?php $pageSize = $widget->dataProvider->getPagination()->pageSize; ?>

<?php if ($index == 0) echo '<div class="row">'; ?>
<div class="col-md-3">

    <strong><?php echo CHtml::link(CHtml::encode($data->complete_name), ['/sSms/viewAddressbook', 'id' => $data->id]); ?>
    </strong>
    <br/>
    <?php echo CHtml::encode($data->handphone); ?>
    <br/>
    <br/>

</div>

<?php
if ($index != 0 && $index != $pageSize && ($index + 1) % 3 == 0)
    echo '</div><div class="row">';
?>

<?php if (($index + 1) == $pageSize) echo '</div>'; ?>

