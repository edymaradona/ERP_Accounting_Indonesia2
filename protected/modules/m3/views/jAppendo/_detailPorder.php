<table class="appendo-gii" id="<?php echo $id ?>">
    <thead>
    <tr>
        <th>Sub Component</th>
        <th>Desc</th>
        <th>User</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($model->budget_id == null): ?>
        <tr>
            <td><?php echo CHtml::dropDownList('budget_id[]', '', aBudget::nonMainComponent()); ?>
            </td>
            <td><?php echo CHtml::textArea('description[]', '', ['class' => 'col-md-5', 'rows' => '2']); ?>
            </td>
            <td><?php echo CHtml::textField('user[]', '', ['class' => 'col-md-3']); ?>
            </td>
            <td><?php echo CHtml::textField('amount[]', '', ['class' => 'col-md-2']); ?>
            </td>
        </tr>
    <?php else: ?>
        <?php for ($i = 0; $i < sizeof($model->budget_id); ++$i): ?>
            <tr>
                <td><?php echo CHtml::dropDownField('budget_id[]', $model->budget_id, aBudget::nonMainComponent()); ?>
                </td>
                <td><?php echo CHtml::textArea('description[]', $model->description, ['maxlength' => 500]); ?>
                </td>
                <td><?php echo CHtml::textField('user[]', $model->user, ['maxlength' => 255]); ?>
                </td>
                <td><?php echo CHtml::textField('amount[]', $model->amount, ['width' => 15, 'maxlength' => 15]); ?>
                </td>
            </tr>
        <?php endfor; ?>
    <?php endif; ?>
    </tbody>
</table>
