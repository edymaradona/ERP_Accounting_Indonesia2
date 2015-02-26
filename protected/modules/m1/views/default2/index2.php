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
            <h1>Dashboard Detail</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'line'],
                        'title' => ['text' => 'Total Employee per Month by Age (' . date("Y") . ')'],
                        'xAxis' => [
                            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des']
                        ],
                        'theme' => 'dark-blue',
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => gPerson2::compEmployeePerMonthAllAge(),
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
                        'title' => ['text' => 'Total Employee per Month by Gender (' . date("Y") . ')'],
                        'xAxis' => [
                            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des']
                        ],
                        'theme' => 'dark-blue',
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => gPerson2::compEmployeePerMonthAllGender(),
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
                        'title' => ['text' => 'Total Employee per Month by Religion (' . date("Y") . ')'],
                        'xAxis' => [
                            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des']
                        ],
                        'theme' => 'dark-blue',
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => gPerson2::compEmployeePerMonthAllReligion(),
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
                .
            </div>
        </div>

        <br/>

    </div>
</div>

