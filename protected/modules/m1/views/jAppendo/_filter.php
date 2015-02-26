<table class="appendo-gii" id="<?php echo $id ?>">
    <thead>
    <tr>
        <th>Field</th>
        <th>Operator</th>
        <th>Value</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($model->field == null): ?>
        <tr>
            <td><?php echo CHtml::dropDownList('fieldfilter[]', '', gBiPerson::getListField('Fill'), ['class' => 'form-control']); ?></td>
            <td><?php
                echo CHtml::dropDownList('expression[]', '', [
                    '' => null,
                    '=' => '= (Sama Dengan)',
                    '<>' => '<> (Selain Daripada)',
                    '>' => '> (Lebih Besar)',
                    '>=' => '>= (Sama Dengan atau Lebih Besar Dari) ',
                    '<' => '< (Lebih Kecil)',
                    '<=' => '<= (Sama Dengan atau Lebih Kecil Dari)',
                    'LIKE' => 'LIKE (Mengandung Huruf/Angka/Kata)',
                    'IN' => 'IN (Mengandung Dua Huruf/Angka/Kata atau Lebih)',
                ], ['class' => 'form-control']);
                ?>
            </td>
            <td><?php echo CHtml::textField('value[]', '', ['class' => 'form-control']); ?></td>
        </tr>
    <?php else: ?>
        <?php for ($i = 0; $i < sizeof($model->fieldfilter); ++$i): ?>
            <tr>
                <td><?php echo CHtml::dropDownList('fieldfilter[]', $model->fieldfilter[$i], gBiPerson::getListField('Fill'), ['class' => 'form-control']); ?></td>
                <td><?php
                    echo CHtml::dropDownList('expression[]', $model->expression[$i], [
                        '' => null,
                        '=' => '=',
                        '<>' => '<>',
                        '>' => '>',
                        '>=' => '>=',
                        '<' => '<',
                        '<=' => '<=',
                        'LIKE' => 'LIKE',
                        'IN' => 'IN',
                    ], ['class' => 'form-control']);
                    ?>
                </td>
                <td><?php echo CHtml::textField('value[]', $model->value[$i], ['class' => 'form-control']); ?></td>
            </tr>
        <?php endfor; ?>
    <?php endif; ?>
    </tbody>
</table>
