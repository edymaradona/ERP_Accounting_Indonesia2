<br/>

<?php

$this->widget('ext.booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        'objective',
        'outline',
        'participant',
        'duration',
        [
            'name' => 'type_id',
            'value' => $model->type->name,
        ],
    ],
]);

