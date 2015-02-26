<?php
//echo CHtml::link("Back to Parent",Yii::app()->createUrl("/m3/aBudget",array("id"=>aBudget::model()->findByPk((int)$id)->getparent->id)));


$this->widget('booster.widgets.TbGridView', [
    'id' => 'a-porder-grid',
    'dataProvider' => aBudget::model()->perBulan($id),
    //'filter'=>$model,
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'columns' => [
        'code',
        'name',
        [
            'name' => 'amount',
            'header' => 'Total Budget',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201201',
            'header' => '2012 01',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201202',
            'header' => '2012 02',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201203',
            'header' => '2012 03',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201204',
            'header' => '2012 04',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201205',
            'header' => '2012 05',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201206',
            'header' => '2012 06',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201207',
            'header' => '2012 07',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201208',
            'header' => '2012 08',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201209',
            'header' => '2012 09',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201210',
            'header' => '2012 10',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201211',
            'header' => '2012 11',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201212',
            'header' => '2012 12',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
    ],
]);
?>
<br/>
<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'a-porder-grid',
    'dataProvider' => aBudget::model()->perBulanDept($id),
    'template' => '{items}',
    //'filter'=>$model,
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => [
        'department',
        //'name',
        [
            'name' => 'amount',
            'header' => 'Total Budget',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201201',
            'header' => '2012 01',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201202',
            'header' => '2012 02',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201203',
            'header' => '2012 03',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201204',
            'header' => '2012 04',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201205',
            'header' => '2012 05',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201206',
            'header' => '2012 06',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201207',
            'header' => '2012 07',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201208',
            'header' => '2012 08',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201209',
            'header' => '2012 09',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201210',
            'header' => '2012 10',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201211',
            'header' => '2012 11',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => '201212',
            'header' => '2012 12',
            'type' => 'number',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
    ],
]);
?>
<hr/>
<br/>
<?php
if (aBudget::model()->perBulanModel($id) != null) {
    $this->Widget('ext.highcharts.HighchartsWidget', [
        'options' => [
            'chart' => ['defaultSeriesType' => 'column'],
            'theme' => 'grid',
            'title' => ['text' => 'Pertumbuhan By Component'],
            'xAxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Des',]
            ],
            'yAxis' => [
                'title' => ['text' => 'Jumlah ( x 100.000)'],
            ],
            'series' => aBudget::model()->perBulanModel($id),
        ],
    ]);
}
?>
