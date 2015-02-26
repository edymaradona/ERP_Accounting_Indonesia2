<?php $row_id = "sladetail-" . $key ?>
<div class='row' id="<?php echo $row_id ?>">
    <?php
    echo $form->hiddenField($model, "[$key]id");
    echo $form->updateTypeField($model, $key, "updateType", ['key' => $key]);
    ?>
    <div class="col-md-3">
        <?php
        echo $form->labelEx($model, "[$key]description");
        echo $form->textField($model, "[$key]description");
        echo $form->error($model, "[$key]description");
        ?>

    </div>

    <div class="col-md-3">
        <?php
        echo $form->labelEx($model, "[$key]qty");
        echo $form->textField($model, "[$key]qty");
        echo $form->error($model, "[$key]qty");
        ?>
    </div>

    <?php /*
      <div class="col-md-3">
      <?php
      echo $form->labelEx($model, "[$key]schedule");

      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
      'model' => $model,
      'attribute' => "[$key]schedule",
      'options' => array(
      'showAnim' => 'fold',
      ),
      'htmlOptions' => array(
      'style' => 'height:20px;'
      ),
      ));
      echo $form->error($model, "[$key]schedule");
      ?>
      </div>
     */
    ?>

    <div class="col-md-3">

        <?php echo $form->deleteRowButton($row_id, $key); ?>
    </div>
</div>