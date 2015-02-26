<table class="appendo-gii" id="<?php echo $id ?>">
    <thead>
    <tr>
        <th>Account No</th>
        <th>Debit</th>
        <th>[ User Remark ]</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($model->account_no_id == null): ?>
        <tr>
            <td><?php echo CHtml::dropDownList('account_no_id[]', "", tAccount::item(), ['class' => 'col-md-2']); ?>
            </td>
            <td><?php echo CHtml::textField('debit[]', '', ['class' => 'span1']); ?>
            </td>
            <td><?php echo CHtml::textField('user_remark[]', '', ['class' => 'col-md-3']); ?>
            </td>
        </tr>
    <?php else: ?>
        <?php for ($i = 0; $i < sizeof($model->account_no_id); ++$i): ?>
            <tr>
                <td><?php echo CHtml::dropDownList('account_no_id[]', $model->account_no_id[$i], tAccount::item(), []); ?>
                </td>
                <td><?php echo CHtml::textField('debit[]', $model->debit[$i], []); ?>
                </td>
                <td><?php echo CHtml::textField('user_remark[]', $model->user_remark[$i], []); ?>
                </td>
            </tr>
        <?php endfor; ?>
    <?php endif; ?>
    </tbody>
</table>
