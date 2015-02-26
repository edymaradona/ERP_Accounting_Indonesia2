<?php

$this->widget('zii.widgets.CListView', [
    'dataProvider' => hApplicantSelection::model()->searchA($model->id, [42]),
    'template' => '{items}{pager}',
    'itemView' => '_tabList',
]);
