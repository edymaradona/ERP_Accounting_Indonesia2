<?php
$this->renderPartial('_menu');
?>

<div class="page-header">
    <h1>Address Book</h1>
</div>

<?php
$this->widget('TbGridView', [
    'id' => 's-addressbook-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        //'category_name',
        [
            'name' => 'complete_name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->complete_name,Yii::app()->createUrl("/sSms/viewAddressbook",array("id"=>$data->id)))',
        ],
        //'company_name',
        'title',
        //'address',
        'handphone',
        //'email',
        [
            'name' => 'member_of',
            //'value' =>'$data->getMemberLink()',
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{update}{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("sSms/deleteAddressbook",array("id"=>$data->id))',
            'updateButtonUrl' => 'Yii::app()->createUrl("sSms/updateAddressbook",array("id"=>$data->id))',
        ],
    ],
]);
?>
