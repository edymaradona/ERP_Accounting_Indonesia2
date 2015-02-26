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
            <h1>Comparison Based on Employee</h1>
        </div>


        <div class="row">
            <div class="col-md-6">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'title' => ['text' => 'Total Employee Composition'],
                        'series' => [
                            ['type' => 'pie', 'name' => 'Project', 'data' => gPerson2::holdingTotal()]
                        ],
                        'theme' => 'dark-blue',
                        'plotOptions' => [
                            'pie' => [
                                'dataLabels' => [
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    'formatter' => "js:function() {
										return '<b>'+ this.point.name +'</b>: '+ parseFloat(this.percentage).toFixed(1) +' %';
									}"
                                ]
                            ]
                        ],
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-6">

                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'column'],
                        'title' => ['text' => 'Total Employee'],
                        'yAxis' => [
                            'title' => ['text' => 'Total Employee']
                        ],
                        'xAxis' => [
                            'categories' => ['Current'],
                        ],
                        'series' => [
                            ['name' => 'Total', 'data' => gPerson2::grandTotal()]
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
                        'title' => ['text' => 'Total Employee by Holding Type'],
                        'series' => [
                            ['type' => 'pie', 'name' => 'Project', 'data' => gPerson2::holdingPerShareTotal()]
                        ],
                        'theme' => 'dark-blue',
                        'plotOptions' => [
                            'pie' => [
                                'dataLabels' => [
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    'formatter' => "js:function() {
										return '<b>'+ this.point.name +'</b>: '+ parseFloat(this.percentage).toFixed(1) +' %';
									}"
                                ]
                            ]
                        ],
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-6">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'title' => ['text' => 'Total Employee by Holding Type'],
                        'series' => [
                            ['type' => 'pie', 'name' => 'Project', 'data' => gPerson2::holdingPerOwnershipTotal()]
                        ],
                        'theme' => 'dark-blue',
                        'plotOptions' => [
                            'pie' => [
                                'dataLabels' => [
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    'formatter' => "js:function() {
										return '<b>'+ this.point.name +'</b>: '+ parseFloat(this.percentage).toFixed(1) +' %';
									}"
                                ]
                            ]
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>	

