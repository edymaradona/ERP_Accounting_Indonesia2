<?php

$this->widget('zii.widgets.CListView', [
    'dataProvider' => hApplicantSelection::model()->searchA($model->id, [11, 12]),
    'template' => '{items}{pager}',
    'itemView' => '_tabList',
]);

