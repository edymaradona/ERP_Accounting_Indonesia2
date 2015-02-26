<br/>

<?php

$this->widget('booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        [
            'label' => 'Parent Organization',
            'type' => 'raw',
            'value' => (isset($model->getparent)) ? CHtml::link($model->getparent->name, Yii::app()->createUrl("/aOrganization/view", ["id" => $model->getparent->id])) : "..ROOT..",
        ],
        //'branch_code_number',
        'branch_code',
        'name',
        'custom1',
        'custom2',
        'custom3',
        'address',
        /*
          array (
          'label'=>'Kab/Kodya',
          'value'=>sKabupatenPropinsi::model()->findByNull((int)$model->kabupaten_id),
          ),
          array (
          'label'=>'Propinsi',
          'value'=>sKabupatenPropinsi::model()->findByNull((int)$model->propinsi_id),
          ),
         */
        'pos_code',
        //'phone_code_area',
        'telephone',
        'fax',
        'email',
        'website',
        [
            'label' => 'Status',
            'value' => $model->getTopStatus(true),
        ],
    ],
]);
