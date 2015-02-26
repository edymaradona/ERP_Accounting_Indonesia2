<table class="appendo-gii" id="<?php echo $id ?>">
    <thead>
    <tr>
        <th>Key</th>
        <th>Value</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($model->account_properties == null): ?>
        <tr>
            <td><?php echo CHtml::dropDownList('account_properties[]', "", Yii::app()->getModule("m2")->ACCOUNT_TYPE_SPEC1); ?>
            </td>
            <td><?php echo CHtml::textField('value[]', ''); ?></td>
        </tr>
    <?php else: ?>
        <?php for ($i = 0; $i < sizeof($model->account_properties); ++$i): ?>
            <tr>
                <td><?php echo CHtml::dropDownList('account_properties[]', $model->account_properties[$i], Yii::app()->getModule("m2")->ACCOUNT_TYPE_SPEC1); ?>
                </td>
                <td>
                    <?php
                    //if ($model->account_properties[$i] == "cashbank_id") {
                    //	echo CHtml::dropDownList('value[]',$model->value[$i],array("Yes"=>"Yes","No"=>"No"));
                    //} elseif ($model->account_properties[$i] == "state_id") {
                    //	echo CHtml::dropDownList('value[]',$model->value[$i],sParameter::items('cStatusAcc'));
                    //} else
                    echo CHtml::textField('value[]', $model->value[$i]);
                    ?>
                </td>
            </tr>
        <?php endfor; ?>
    <?php endif; ?>
    </tbody>
</table>
