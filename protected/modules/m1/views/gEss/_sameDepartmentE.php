<?php if (isset($model->company->department_id) && in_array($model->mCompanyId(), sUser::model()->getMyGroupArray())): ?>

    <h4>Same Department </h4>
    <?php $dataProvider = gPerson::model()->sameDepartment($model->mDepartmentId()); ?>

    <?php foreach ($dataProvider->getData() as $key => $data): ?>
        <?php
        if (($key + 3) % 3 == 0) {
            echo "<div class='row' style='margin-bottom:10px;'>";
        }
        ?>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $data->PhotoPath; ?>
                </div>
                <div class="col-md-9">
                    <?php echo CHtml::tag('div', ['style' => 'font-weight: bold'], $data->employee_name) ?>
                    <?php echo CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->handphone . ' ' . $data->email); ?>
                    <?php
                    $un = isset($data->user->username) ? $data->user->username : "";
                    echo CHtml::link('Send Message', Yii::app()->createUrl('mailbox/message/new', ['to' => $un]), ['class' => 'btn btn-xs btn-default'])
                    ?>
                </div>
            </div>
        </div>

        <?php
        if (($key + 4) % 3 == 0) {
            echo "</div>";
            //echo ($key);
        }
        $endkey = $key;

    endforeach;

    if (isset($endkey) && ($endkey == 0 || ($endkey + 4) % 3 != 0)) {
        echo "</div>";
        //echo $key;
    }
    ?>



<?php





endif;

