<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-reorder fa-fw"></i>
            <?php
            echo " New Journal ";
            ?></li>
    </ul>
</div>

<ul>
    <?php
    $criteria = new CDbCriteria;
    $criteria->order = 't.input_date DESC';
    $criteria->compare('yearmonth_periode', Yii::app()->params["cCurrentPeriod"]);

    $criteria->limit = 10;


    $models = tJournal::model()->findAll($criteria);

    foreach ($models as $model) {
        echo CHtml::openTag('li', []);
        echo CHtml::tag('strong', [], $model->linkUrl);
        echo "<br/>";
        echo CHtml::tag('strong', [], $model->input_date . " | " . peterFunc::indoFormat($model->journalSum));
        echo "<br/>";
        echo CHtml::tag('div', ['style' => 'font-size:12px;color:grey'], $model->remark);
        echo CHtml::closeTag('li');
    }
    ?>
</ul>

