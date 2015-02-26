<p>
    <?php
    echo CHtml::link('Export to Excel', Yii::app()->createUrl('/m1/hVacancy/toExcel', ["id" => $model->id, 'tab' => 'interview']), ['class' => 'btn btn-info']);
    ?>
</p>

<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => hApplicantSelection::model()->searchA($model->id, [32]),
    'template' => '{items}{pager}',
    'itemView' => '_tabListEmail',
]);

