<div class="page-header">
    <h1><i class="fa fa-table fa-fw"></i>
        User Login History</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbGridView', [
            'id' => 'yii-log-grid',
            'dataProvider' => sUserHistory::model()->search(Yii::app()->user->id),
            'itemsCssClass' => 'table table-striped',
            'template' => '{items}{pager}',
            'columns' => [
                'ip_address',
                //array(
                //	'header'=>'Location',
                //	'value'=> '$data->location["region_name"]',
                //),
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