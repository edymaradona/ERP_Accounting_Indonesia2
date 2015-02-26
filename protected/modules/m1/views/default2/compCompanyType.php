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
            <h1>Comparison Based on Company Type</h1>
        </div>

        <?php
        $this->Widget('ext.highcharts.HighchartsWidget', [
            'options' => [
                'chart' => ['defaultSeriesType' => 'column'],
                'title' => ['text' => 'Employee Composition (Holding)'],
                'xAxis' => [
                    'categories' => gPerson2::compByParent(971),
                    'labels' => [
                        'rotation' => -90,
                        'align' => 'right',
                    ],
                ],
                'yAxis' => [
                    'title' => ['text' => 'Total']
                ],
                'series' => [
                    ['name' => 'Project', 'data' => gPerson2::proEmployee(971)]
                ],
                'theme' => 'dark-blue',
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
            ],
            'htmlOptions' => [
                'style' => 'height:800px',
            ]
        ]);
        ?>

        <br/>

        <?php
        $this->Widget('ext.highcharts.HighchartsWidget', [
            'options' => [
                'chart' => ['defaultSeriesType' => 'column'],
                'title' => ['text' => 'Employee Composition (Developer)'],
                'xAxis' => [
                    'categories' => gPerson2::compByParent(669),
                    'labels' => [
                        'rotation' => -90,
                        'align' => 'right',
                    ],
                ],
                'yAxis' => [
                    'title' => ['text' => 'Total'],
                ],
                'series' => [
                    ['name' => 'Project', 'data' => gPerson2::proEmployee(669)]
                ],
                'theme' => 'dark-blue',
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
            ],
            'htmlOptions' => [
                'style' => 'height:800px',
            ]
        ]);
        ?>

        <br/>

        <?php
        $this->Widget('ext.highcharts.HighchartsWidget', [
            'options' => [
                'chart' => ['defaultSeriesType' => 'column'],
                'title' => ['text' => 'Employee Composition (POM)'],
                'xAxis' => [
                    'categories' => gPerson2::compByParent(670),
                    'labels' => [
                        'rotation' => -90,
                        'align' => 'right',
                    ],
                ],
                'yAxis' => [
                    'title' => ['text' => 'Total']
                ],
                'series' => [
                    ['name' => 'Project', 'data' => gPerson2::proEmployee(670)]
                ],
                'theme' => 'dark-blue',
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
            ],
            'htmlOptions' => [
                'style' => 'height:800px',
            ]
        ]);
        ?>
    </div>
</div>

