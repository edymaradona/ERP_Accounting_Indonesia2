<?php
$this->breadcrumbs = [
    $this->module->id,
];
?>

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>
                <i class="fa fa-user fa-fw"></i>
                Employee List: Request Transfer to Employee
            </h1>
        </div>

        <?php foreach (hApplicant::model()->employeeTransferRequest()->getData() as $key => $data): ?>
            <?php
            if (($key + 2) % 2 == 0) {
                echo "<div class='row' style='margin-bottom:10px;'>";
            }
            ?>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-1">
                        <?php echo CHtml::link($data->PhotoPath, Yii::app()->createUrl("$this->route", ["id" => $data->id,])); ?>
                    </div>
                    <div class="col-md-5">
                        <?php
                        echo CHtml::link($data->applicant_name, Yii::app()->createUrl('/m1/hApplicant/view', ['id' => $data->id]))
                            . CHtml::tag('div', [], $data->birth_date)
                            . CHtml::tag('div', [], $data->address1)
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->handphone);
                        ?>
                        <?php
                        echo CHtml::tag('div', ['style' => 'font-weight: bold'], CHtml::link('Transfer', Yii::app()->createUrl('/m1/gPerson/createTransfer', ['id' => $data->id]), ['class' => 'btn btn-primary btn-xs'])
                        )
                        ?>
                    </div>
                </div>
            </div>

            <?php
            if (($key + 3) % 2 == 0) {
                echo "</div>";
                echo "<br/>";
                //echo ($key);
            }
            $endkey = $key;

        endforeach;

        if (isset($endkey) && ($endkey == 0 || ($endkey + 2) % 2 != 0)) {
            echo "</div>";
            echo "<br/>";
            //echo $key;
        }
        ?>


    </div>
</div>





