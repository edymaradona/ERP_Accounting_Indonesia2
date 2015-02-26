<?php
$this->renderPartial('_menu');
?>

<div class="page-header">
    <h1><i class="fa fa-envelope fa-fw"></i>
        Sent</h1>
</div>

<?php
$this->widget('TbGridView', [
    'id' => 's-smsout-grid',
    'dataProvider' => sSmsout::model()->search(),
    'itemsCssClass' => 'table table-striped table-condensed',
    'template' => '{items}{pager}',
    //'filter' => $model,
    'enableSorting' => false,
    'columns' => [
        [
            'header' => 'Time',
            'type' => 'raw',
            'value' => 'date("d-m-Y h:i",$data->created_date)',
        ],
        'receivergroup_tag',
        //'modem',
        [
            'name' => 'message',
            'type' => 'raw',
            'value' => 'CHtml::link($data->message,Yii::app()->createUrl("/sSms/view",array("id"=>$data->id)))'
        ],
        [
            'header' => 'Sender',
            'type' => 'raw',
            'value' => '$data->created->username',
        ],
        /*
          'approved_id',
         */
        //array(
        //	'class'=>'TbButtonColumn',
        //),
    ],
]);
?>



