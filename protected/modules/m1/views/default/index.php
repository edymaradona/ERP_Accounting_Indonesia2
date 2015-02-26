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
            <div class="col-md-6">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'line'],
                        'title' => ['text' => 'Total Employee per Month (' . date("Y") . ')'],
                        'theme' => 'dark-blue',
                        'xAxis' => [
                            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => gPerson2::compEmployeePerMonth(),
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
                <br/>
            </div>
            <div class="col-md-6">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'column'],
                        'title' => ['text' => 'Employee In and Out by Month (' . date("Y") . ')'],
                        'xAxis' => [
                            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => gPerson2::compEmployeeIn(),
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
                        'chart' => ['defaultSeriesType' => 'column'],
                        'title' => ['text' => 'Promotion-Mutation-Demotion per Month (' . date("Y") . ')'],
                        'xAxis' => [
                            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Total']
                        ],
                        'series' => gPerson2::compEmployeePmd(),
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


        <?php /*
          <br/>

          <div class="row">
          <div class="col-md-5">
          <?php
          $this->Widget('ext.highcharts.HighchartsWidget', array(
          'options' => array(
          'chart' => array('defaultSeriesType' => 'line'),
          'title' => array('text' => 'Training Aggressivity per Month (' . date("Y") . ')'),
          'xAxis' => array(
          'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
          ),
          'yAxis' => array(
          'title' => array('text' => 'Total')
          ),
          'series' => iLearningSch::compLearningHoursPerMonthPerBu(),
          //'series' => array(
          //	 array('name' => 'Total Hours', 'data' => array(500, 550, 625,700,1000,1250,1750,1800,2000,2220,2400,2700)),
          //),
          'plotOptions' => array(
          'column' => array(
          'dataLabels' => array(
          'enabled' => true,
          'color' => 'colors[0]',
          'style' => array(
          'fontWeight' => 'bold'
          ),
          )
          )
          ),
          )
          ));
          ?>
          </div>
          <div class="col-md-5">
          <?php
          $this->Widget('ext.highcharts.HighchartsWidget', array(
          'options' => array(
          'chart' => array('defaultSeriesType' => 'column'),
          'title' => array('text' => 'Total Participant and Class per Month (' . date("Y") . ')'),
          'xAxis' => array(
          'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
          ),
          'yAxis' => array(
          'title' => array('text' => 'Total')
          ),
          'series' => iLearningSch::compLearningClassPerMonthPerBu(),
          'plotOptions' => array(
          'column' => array(
          'dataLabels' => array(
          'enabled' => true,
          'color' => 'colors[0]',
          'style' => array(
          'fontWeight' => 'bold'
          ),
          )
          )
          ),
          )
          ));
          ?>
          </div>
          </div>
         */
        ?>

    </div>
</div>

