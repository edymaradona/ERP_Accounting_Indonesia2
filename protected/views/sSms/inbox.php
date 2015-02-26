<?php
$this->renderPartial('_menu');
?>

<div class="page-header">
    <h1><i class="fa fa-envelope fa-fw"></i>
        Inbox</h1>
</div>

<?php
$this->widget('TbGridView', [
    'id' => 's-smsout-grid',
    'dataProvider' => sSmsin::model()->search(),
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
        'sender_number',
        //'modem',
        [
            'name' => 'message',
            'type' => 'raw',
            'value' => 'CHtml::link($data->message,Yii::app()->createUrl("/sSmsout/view",array("id"=>$data->id)))'
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
