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
            <h1>Comparison By Profile</h1>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'column'],
                        'title' => ['text' => 'Employee Composition by Age'],
                        'theme' => 'dark-blue',
                        'xAxis' => [
                            'categories' => ['<26', '26-30', '31-35', '36-40', '41-45', '46-50', '51-55', '>55']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => [
                            ['name' => 'Age', 'data' => gPerson2::compAgeAll()]
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
                        'title' => ['text' => 'Employee Composition by Gender'],
                        'xAxis' => [
                            'categories' => ['Male', 'Female']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => [
                            ['name' => 'Sex', 'data' => gPerson2::compSexAll()]
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
                        'title' => ['text' => 'Employee Composition by Religion'],
                        'xAxis' => [
                            'categories' => ['Islam', 'Kr. Protestan', 'Kr. Katolik', 'Budha', 'Hindu', 'Kong Hu Cu']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => [
                            ['name' => 'Religion', 'data' => gPerson2::compReligionAll()]
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
                        'title' => ['text' => 'Employee Composition by Education'],
                        'xAxis' => [
                            'categories' => ['NE', 'SLTP', 'SLTA', 'Dipl', 'S1', 'S2', 'S3']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => [
                            ['name' => 'Education', 'data' => gPerson2::compEducationAll()]
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

    </div>
</div>

