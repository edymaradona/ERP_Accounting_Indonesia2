<?php

$this->widget('zii.widgets.CListView', [
    'dataProvider' => hVacancyApplicant::model()->search($model->id, 7),
    'template' => '{items}{pager}',
    'itemView' => '_tabList',
]);

