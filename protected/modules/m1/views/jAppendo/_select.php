<table class="appendo-gii" id="<?php echo $id ?>">
    <thead>
    <tr>
        <th>Field</th>
        <th>Group By</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($model->field == null): ?>
        <tr>
            <td>
                <div class="form-group">
                    <?php echo CHtml::dropDownList('field[]', '', gBiPerson::getListField(), ['class' => 'form-control']); ?>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <?php
                    echo CHtml::dropDownList('group[]', '', [
                        '' => null,
                        //'GROUP BY'=>'GROUP BY',
                        //'SUM'=>'SUM',
                        //'COUNT'=>'COUNT',
                        //'MAX'=>'MAX',
                        //'MIN'=>'MIN',
                        //'AVERAGE'=>'AVERAGE',
                    ]);
                    ?>
                </div>
            </td>
        </tr>
    <?php else: ?>
        <?php for ($i = 0; $i < sizeof($model->field); ++$i): ?>
            <tr>
                <td>
                    <div class="form-group">
                        <?php echo CHtml::dropDownList('field[]', $model->field[$i], gBiPerson::getListField(), ['class' => 'form-control']); ?>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <?php
                        echo CHtml::dropDownList('group[]', $model->group[$i], [
                            '' => null,
                            //'GROUP BY'=>'GROUP BY',
                            //'SUM'=>'SUM',
                            //'COUNT'=>'COUNT',
                            //'MAX'=>'MAX',
                            //'MIN'=>'MIN',
                            //'AVERAGE'=>'AVERAGE',
                        ], ['class' => 'form-control']);
                        ?>
                    </div>
                </td>
            </tr>
        <?php endfor; ?>
    <?php endif; ?>
    </tbody>
</table>
