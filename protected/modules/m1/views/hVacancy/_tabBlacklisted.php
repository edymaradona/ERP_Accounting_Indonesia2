<?php

$this->widget('zii.widgets.CListView', [
    'dataProvider' => hVacancyApplicant::model()->search($model->id, 6),
    'template' => '{items}{pager}',
    'itemView' => '_tabList',
]);
