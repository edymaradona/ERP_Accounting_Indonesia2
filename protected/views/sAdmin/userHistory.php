<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Yii Log', 'url' => Yii::app()->createUrl('/sAdmin/yiiLog')],
        ['label' => 'All User History', 'url' => Yii::app()->createUrl('/sAdmin/userHistory'), 'active' => true],
    ],
    'htmlOptions' => [

    ]
]);
?>


<div class="page-header">
    <h1><i class="fa fa-table fa-fw"></i>
        User Login History</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbGridView', [
            'id' => 'yii-log-grid',
            'dataProvider' => sUserHistory::model()->searchAll(),
            'itemsCssClass' => 'table table-striped',
            'template' => '{items}{pager}',
            'columns' => [
                [
                    'header' => 'User Name',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->user->username,Yii::app()->createUrl("/sUser/view",array("id"=>$data->user_id)))',
                ],
                [
                    'header' => 'Default Entity',
                    'value' => '$data->user->organization->name',
                ],
                'ip_address',
                [
                    'header' => 'Location',
                    'value' => '$data->location["region_name"]',
                ],
                [
                    'name' => 'log_time',
                    'value' => 'peterFunc::nicetime($data->log_time)',
                ],
                'browser_name'
            ],
        ]);
        ?>

    </div>
</div>