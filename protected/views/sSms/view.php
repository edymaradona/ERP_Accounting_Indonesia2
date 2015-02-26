<?php
$this->renderPartial('_menu');
?>

    <div class="page-header">
        <h1>Broadcast SMS</h1>
    </div>

<?php
$this->beginWidget('booster.widgets.TbHeroUnit', [
    'heading' => false,
]);

echo CHtml::tag('strong', [], $model->message);

$this->endWidget();
?>


<?php
$this->widget('TbDetailView', [
    'data' => $model,
    'attributes' => [
        //array(
        //	'label'=>'Group',
        //	'name'=>'sender.name',
        //),
        'receivergroup_tag',
        'approved_id',
        [
            'label' => 'Created By',
            'name' => 'created.username',
        ],
        [
            'label' => 'Sent',
            'value' => peterFunc::nicetime($model->created_date),
        ],
    ],
]);
?>

    <h4>List of Receipient</h4>

<?php
$this->widget('TbGridView', [
    'id' => 's-addressbook-grid',
    'dataProvider' => sAddressbookGroup::model()->listRecepient($model->id),
    //'filter' => $model,
    'columns' => [
        //'category_name',
        [
            'name' => 'complete_name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->complete_name,Yii::app()->createUrl("/sAddressbook/view",array("id"=>$data->id)))',
        ],
        //'company_name',
        'title',
        'handphone',
        'member_of',
    ],
]);
?>