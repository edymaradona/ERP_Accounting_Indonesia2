<br/>

<div class="row">
    <div class="col-md-2">
        <?php echo $model->PhotoPath; ?>

        <div style="font-size:11px">Performance Completeness <span
                class="pull-right strong"><?php echo peterFunc::indoFormat($model->completionTalent) ?>%</span>
            <?php
            $this->widget('booster.widgets.TbProgress', [
                'context' => 'success', // 'info', 'success' or 'danger'
                'percent' => $model->completionTalent,
                'htmlOptions' => [
                    'style' => 'height:7px',
                ]
            ]);
            ?>
        </div>


        <div style="text-align:center; padding:10px 0">
            <?php echo CHtml::link('Print Profile', Yii::app()->createUrl('/m1/gPerformance/printProfile', ['id' => $model->id]), ['class' => 'btn btn-primary btn-xs', 'target' => '_blank'])
            ?>
        </div>
    </div>
    <div class="col-md-10">
        <?php echo $this->renderPartial('/gPerson/_personalInfo', ['model' => $model]); ?>
    </div>
</div>

<h3>Career</h3>
<?php echo $this->renderPartial('/gPerson/_tabCareer', ["model" => $model]); ?>

<h3>Experience</h3>
<?php echo $this->renderPartial('/gPerson/_tabExperience', ["model" => $model]); ?>

<h3>Status</h3>
<?php
echo $this->renderPartial('/gPerson/_tabStatus', ["model" => $model]);
