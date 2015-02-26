<?php

$this->widget('zii.widgets.CListView', [
    'dataProvider' => hApplicantSelection::model()->searchA($model->id, [22]),
    'template' => '{items}{pager}',
    'itemView' => '_tabList',
]);

