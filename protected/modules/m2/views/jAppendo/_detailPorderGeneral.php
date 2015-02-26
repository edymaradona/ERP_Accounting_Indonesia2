<table class="appendo-gii" id="<?php echo $id ?>">
    <thead>
    <tr>
        <th>Budget</th>
        <th>Desc</th>
        <th>Qty</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($model->budget_id == null): ?>
        <tr>
            <td><?php echo CHtml::dropDownList('budget_id[]', '', tAccount::item()); ?>
            </td>
            <td><?php echo CHtml::textField('description[]', '', []); ?>
            </td>
            <td><?php echo CHtml::textField('qty[]', '', ['maxlength' => 15]); ?>
            </td>
            <td><?php echo CHtml::textField('amount[]', '', ['maxlength' => 15]); ?>
            </td>
        </tr>
    <?php else: ?>
        <?php for ($i = 0; $i < sizeof($model->budget_id); ++$i): ?>
            <tr>
                <td><?php echo CHtml::dropDownList('budget_id[]', $model->budget_id[$i], tAccount::item()); ?>
                </td>
                <td><?php echo CHtml::textField('description[]', $model->description[$i], []); ?>
                </td>
                <td><?php echo CHtml::textField('qty[]', $model->qty[$i], ['maxlength' => 15]); ?>
                </td>
                <td><?php echo CHtml::textField('amount[]', $model->amount[$i], ['maxlength' => 15]); ?>
                </td>
            </tr>
        <?php endfor; ?>
    <?php endif; ?>
    </tbody>
</table>
