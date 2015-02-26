<div>
    <?php
    /* @var $this SlaController */
    ?>

    <p>
        Example form of a one to many models with dynamic inputs!
    </p>
    <?php
    $form = $this->beginWidget('ext.DynamicTabularForm.DynamicTabularForm', [
        'defaultRowView' => '_rowForm',
    ]);
    echo "<h3>Header</h3>";
    echo $form->errorSummary($sla);
    ?>
    <div class="row">
        <div class="col-md-4">
            <?php
            echo $form->labelEx($sla, 'customer_id');
            echo $form->dropDownList($sla, 'customer_id', uCustomer::items());
            echo $form->error($sla, 'customer_id');
            ?>
        </div>

        <div class="col-md-4">
            <?php
            echo $form->labelEx($sla, 'input_date');
            echo $form->textField($sla, 'input_date');
            echo $form->error($sla, 'input_date');
            ?>
        </div>

    </div>
    <h3>Details</h3>
    <?php
    /**
     * this is the main feature!!
     */
    echo $form->rowForm($sladetails);

    echo CHtml::submitButton('create');

    $this->endWidget();
    ?>
</div>