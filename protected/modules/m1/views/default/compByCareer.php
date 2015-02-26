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
            <h1>Comparison By Career</h1>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'column'],
                        'title' => ['text' => 'Employee Composition by Service Years'],
                        'theme' => 'dark-blue',
                        'xAxis' => [
                            'categories' => ['<1', '1-2', '3-4', '5-6', '7-8', '>8']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => [
                            ['name' => 'Working Years', 'data' => gPerson2::compWorking()]
                        ],
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
            <div class="col-md-6">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'column'],
                        'title' => ['text' => 'Employee Composition by Level'],
                        'xAxis' => [
                            'categories' => ['Pelaksana', 'Officer', 'Supervisor', 'Manager', 'General Manager', 'Vice President']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => [
                            ['name' => 'Level', 'data' => gPerson2::compLevel()]
                        ],
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
            <div class="col-md-6">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'column'],
                        'title' => ['text' => 'Employee Composition by Status'],
                        'xAxis' => [
                            'categories' => ['Contract', 'Probation', 'Permanent', 'Daily Worker']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => [
                            ['name' => 'Status', 'data' => gPerson2::compStatus()]
                        ],
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
            <div class="col-md-6">
                .
            </div>
        </div>

    </div>
</div>

