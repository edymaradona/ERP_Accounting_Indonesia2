<br/>

<?php

$this->widget('booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        'employee_code',
        [
            'label' => 'Birth Place',
            'value' => $model->birth_place,
        ],
        [
            'label' => 'Birth Date',
            'value' => $model->birth_date . " " . CHtml::tag('span', ['class' => 'badge badge-info'], $model->countAgeRoundDown() . ' years'),
            'type' => 'raw',
        ],
        //'birth_date',
        [
            'label' => 'Gender',
            'value' => $model->sex->name,
        ],
        [
            'label' => 'Religion',
            'value' => $model->religion()->name,
        ],
        [
            'label' => 'Marital Status',
            'value' => $model->maritalStatus(),
        ],
        [
            'label' => 'Marital Tax Status',
            'value' => $model->maritalTaxStatus(),
        ],
        'blood_id',
        'address1',
        'address2',
        'address3', 
        'pos_code',
        'identity_number',
        'identity_valid',
        'identity_address1',
        /* 'identity_address2',
          'identity_address3', */
        'identity_pos_code', 
        [
            'label' => 'Email',
            'type' => 'email',
            'value' => $model->email . ' ' . $model->isValidEmail,
            //'value' => $model->email,
        ],
        //'email2',
        'home_phone',
        'handphone',
        //'handphone2',
        'account_number',
        'account_name',
        'bank_name',
    ],
]);


