<?php

$this->widget('booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        'pic',
        'address',
        'city',
        'pos_code',
        'province',
        'telephone',
        'fax',
        'email',
        'status_id',
    ],
]);
?>
