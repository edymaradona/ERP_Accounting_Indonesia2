<?php
$this->beginWidget('booster.widgets.TbBox', [
    'title' => false,
    'headerIcon' => 'icon-fa-globe',
    'htmlHeaderOptions' => ['style' => 'background:white'],
    //'htmlContentOptions'=>array('style'=>'background:#FFA573'),
]);
?>

<div class="row">
    <div class="col-md-4">
        <h3>
            <?php
            echo CHtml::link($data->system_reff, ['view', 'id' => $data->id]);
            ?>
        </h3>

        <p>
            <?php
            if ($data->state_id != 4) {
                echo CHtml::link('delete', "#", ["class" => "btn btn-mini", "submit" => ['delete', 'id' => $data->id], 'confirm' => 'Are you sure to delete this journal?']);
                echo " ";
                echo CHtml::link('update', Yii::app()->createUrl($this->module->id . '/' . $this->id . '/update', ["id" => $data->id]), ["class" => "btn btn-mini"]);
                echo " ";
            }
            echo CHtml::link('<i class="fam-printer"></i>', Yii::app()->createUrl($this->module->id . '/' . $this->id . '/print', ["id" => $data->id]), ['target' => '_blank', "class" => "btn btn-mini"]);

            echo ($data->journalSum != $data->journalSumCek) ? " WARNING!!!... FAULT BY SYSTEM. JOURNAL IS NOT BALANCE, PLEASE DELETE.." : "";
            ?>
        </p>


        <?php if ($data->remark != null) { ?>
            <p>
                <?php echo CHtml::encode($data->remark); ?>
            </p>
        <?php }; ?>
    </div>

    <div class="col-md-8">
        <?php
        $this->renderPartial('/tJournal/_viewJournalInfo', ['data' => $data]);
        ?>
    </div>
</div>

<?php echo $this->renderPartial('/tJournal/_viewDetail', ['data' => $data]); ?>

<?php
$this->endWidget();
?>

