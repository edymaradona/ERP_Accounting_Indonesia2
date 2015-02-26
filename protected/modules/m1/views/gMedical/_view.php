<div class="row">
    <div class="col-md-12">
        <h3>
            <?php echo CHtml::link(CHtml::encode($data->employee_name), ['view', 'id' => $data->id]); ?>
        </h3>
    </div>
</div>

<?php
echo $this->renderPartial('/gPerson/_viewDetail', ['data' => $data]);
