<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */

$this->breadcrumbs = [
    'User Registration' => ['index'],
];

$this->menu5 = ['User Registration'];
?>

<div class="page-header">
    <h1><i class="fa fa-user fa-fw"></i>User Registration List</h1>
</div>

<?php
$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 's-user-registration-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        //'activation_code',
        'email',
        //'password',
        'status.name',
        [
            'class' => 'TbButtonColumn',
        ],
        'module_name',
        [
            'header' => 'Registration Time',
            'value' => 'peterFunc::nicetime($data->registration_date)',
            'filter' => false,
        ],
        [
            'type' => 'raw',
            'value' => '(isset($data->applicant)) ? 
						CHtml::link($data->applicant->applicant_name,Yii::app()->createUrl("m1/hApplicant/view",array("id"=>$data->id))) : ""',
            'header' => 'Applicant',
        ],
    ],
]);
?>
