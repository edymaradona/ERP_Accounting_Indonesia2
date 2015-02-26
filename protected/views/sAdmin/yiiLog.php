<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Yii Log', 'url' => Yii::app()->createUrl('/sAdmin/yiiLog'), 'active' => true],
        ['label' => 'All User History', 'url' => Yii::app()->createUrl('/sAdmin/userHistory')],
    ],
    'htmlOptions' => [

    ]
]);
?>

<div class="page-header">
    <h1><i class="fa fa-table fa-fw"></i>
        Yii Log</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbGridView', [
            'id' => 'yii-log-grid',
            'dataProvider' => $dataProvider,
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}',
            'columns' => [
                //array(
                //	'header'=>'Sr #',
                //    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                //),
                [
                    'type' => 'raw',
                    'value' => function ($data) {
                            return CHtml::tag('div', [], $data["IP_User"])
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data["user_name"])
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data["logtime"]);
                        }
                ],
                [
                    'type' => 'raw',
                    'value' => function ($data) {
                            return CHtml::tag('div', [], substr($data["request_URL"], 0, 100))
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], peterFunc::shorten_string($data["message"], 20));
                        }
                ],
            ],
        ]);
        ?>

    </div>
</div>