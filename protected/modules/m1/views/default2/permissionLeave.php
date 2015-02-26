<?php
$this->breadcrumbs = [
    $this->module->id,
];
?>

<div class="row">
    <div class="col-md-2">
        <?php echo $this->renderPartial('_menuNavigation'); ?>
    </div>

    <div class="col-md-10">

        <div class="page-header">
            <h1>Main Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'line'],
                        'title' => ['text' => 'Permission Request last 100 days'],
                        'xAxis' => [
                            'categories' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => gPerson2::linePermission(),
                        'plotOptions' => [
                            'column' => [
                                'dataLabels' => [
                                    'enabled' => true,
                                    'color' => 'colors[0]',
                                    'style' => [
                                        'fontWeight' => 'bold'
                                    ],
                                ]
                            ]
                        ],
                    ]
                ]);
                ?>
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="col-md-12">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'line'],
                        'title' => ['text' => 'Leave Request last 100 days'],
                        'xAxis' => [
                            'categories' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => gPerson2::lineLeave(),
                        'plotOptions' => [
                            'column' => [
                                'dataLabels' => [
                                    'enabled' => true,
                                    'color' => 'colors[0]',
                                    'style' => [
                                        'fontWeight' => 'bold'
                                    ],
                                ]
                            ]
                        ],
                    ]
                ]);
                ?>
            </div>
        </div>


    </div>
</div>

