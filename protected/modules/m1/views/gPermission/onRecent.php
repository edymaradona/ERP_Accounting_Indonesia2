<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPermission']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


//$this->menu1=gPermission::getTopUpdated();
//$this->menu2=gPermission::getTopCreated();
$this->menu5 = ['Permission'];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-medkit fa-fw"></i>
            Permission
        </h1>
    </div>

<?php
$this->renderPartial('_search', [
    'model' => $model,
]);
?>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Waiting for Approval', 'url' => Yii::app()->createUrl('/m1/gPermission')],
        ['label' => 'Approved By Superior', 'url' => Yii::app()->createUrl('/m1/gPermission/onSuperior')],
        ['label' => 'Approved Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onApproved')],
        ['label' => 'Employee On Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onPermission')],
        ['label' => 'Recent Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onRecent'), 'active' => true],
    ],
    'htmlOptions' => [

    ]
]);
?>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => gPermission::model()->OnRecent(),
    //'filter'=>$model,
    'template' => '{items}{pager}',
    'columns' => [
        [
            'type' => 'raw',
            'value' => '$data->person->photoPath',
            'htmlOptions' => ["width" => "50px"],
        ],
        [
            'header' => 'Name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->person->employee_name,Yii::app()->createUrl("/m1/gPermission/view",array("id"=>$data->parent_id)))',
        ],
        [
            'header' => 'Department',
            'name' => 'person.company.department.name',
        ],
        'start_date',
        'end_date',
        'number_of_day',
        [
            'header' => 'Approved By',
            'name' => 'updated.username',
        ],
    ],
]);
