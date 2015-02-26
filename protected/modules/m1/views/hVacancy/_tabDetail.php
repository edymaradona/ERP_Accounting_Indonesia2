<br/>

<?php

$this->widget('TbDetailView', [
    'data' => $model,
    'attributes' => [
        'company_name',
        [
            'name' => 'industry.name',
            'label' => 'Industry'
        ],
        [
            'name' => 'level.name',
            'label' => 'Level'
        ],
        [
            'name' => 'spec.name',
            'label' => 'Specialization'
        ],
        'work_address',
        'work_area',
        'salary_currency',
        'salary_min',
        'salary_max',
        'min_work_exp',
        [
            'name' => 'min_edulvl',
            'value' => $model->edulevel->name,
        ],
        'min_grade',
        'skill_required',
    ],
]);

