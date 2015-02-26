<?php
$this->breadcrumbs = [
    $this->module->id,
];
?>

<div class="row">
    <div class="col-md-2">
        <?php echo $this->renderPartial('_menuNavigation'); ?>
    </div>

    <div class="col-md-10">
        <div class="page-header">
            <h1>
                <i class="fa fa-user fa-fw"></i>
                Employee List: Request to Mutation
            </h1>
        </div>

        <?php foreach (gPerson::model()->employeeMutationRequest()->getData() as $key => $data): ?>
            <?php
            if (($key + 3) % 3 == 0) {
                echo "<div class='row' style='margin-bottom:10px;'>";
            }
            ?>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <?php echo CHtml::link($data->PhotoPath, Yii::app()->createUrl("$this->route", ["id" => $data->id,])); ?>
                    </div>
                    <div class="col-md-9">
                        <?php
                        echo CHtml::tag('div', ['style' => 'font-weight: bold'], $data->GPersonLink)
                            . CHtml::tag('div', [], $data->mCompany())
                            . CHtml::tag('div', [], $data->mDepartment())
                            . CHtml::tag('div', [], $data->mJobTitle())
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->mLevel());
                        ?>
                        <?php //echo CHtml::tag('div', array('style' => 'font-weight: bold'), $data->GPersonLink) ?>
                        <?php //echo CHtml::tag('div', [], $data->mJobTitle()) ?>
                        <?php //echo CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->mLevel()); ?>
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


    </div>
</div>





