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
    <h1>Uncomplete Data</h1>
</div>

<div style="width:100%">
    <?php
    $this->Widget('ext.highcharts.HighchartsWidget', [
        'options' => [
            'chart' => ['defaultSeriesType' => 'column'],
            'title' => ['text' => 'Basic Profile'],
            'theme' => 'dark-blue',
            'xAxis' => [
                'categories' => gPerson::getUncompleteHoldingCompany(),
                'labels' => [
                    'rotation' => -90,
                    'align' => 'right',
                ],
            ],
            'yAxis' => [
                'title' => ['text' => 'Total']
            ],
            'series' => [
                ['name' => 'Company', 'data' => gPerson::getUncompleteHolding("basic")]
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
    <br/>
</div>

<div style="width:100%">
    <?php
    $this->Widget('ext.highcharts.HighchartsWidget', [
        'options' => [
            'chart' => ['defaultSeriesType' => 'column'],
            'title' => ['text' => 'Education'],
            'xAxis' => [
                'categories' => gPerson::getUncompleteHoldingCompany(),
                'labels' => [
                    'rotation' => -90,
                    'align' => 'right',
                ],
            ],
            'yAxis' => [
                'title' => ['text' => 'Total']
            ],
            'series' => [
                ['name' => 'Company', 'data' => gPerson::getUncompleteHolding("education")]
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
    <br/>
</div>

<div style="width:100%">
    <?php
    $this->Widget('ext.highcharts.HighchartsWidget', [
        'options' => [
            'chart' => ['defaultSeriesType' => 'column'],
            'title' => ['text' => 'Family'],
            'xAxis' => [
                'categories' => gPerson::getUncompleteHoldingCompany(),
                'labels' => [
                    'rotation' => -90,
                    'align' => 'right',
                ],
            ],
            'yAxis' => [
                'title' => ['text' => 'Total']
            ],
            'series' => [
                ['name' => 'Company', 'data' => gPerson::getUncompleteHolding("family")]
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
    <br/>
</div>

<div style="width:100%">
    <?php
    $this->Widget('ext.highcharts.HighchartsWidget', [
        'options' => [
            'chart' => ['defaultSeriesType' => 'column'],
            'title' => ['text' => 'Experience'],
            'xAxis' => [
                'categories' => gPerson::getUncompleteHoldingCompany(),
                'labels' => [
                    'rotation' => -90,
                    'align' => 'right',
                ],
            ],
            'yAxis' => [
                'title' => ['text' => 'Total']
            ],
            'series' => [
                ['name' => 'Company', 'data' => gPerson::getUncompleteHolding("experience")]
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
    <br/>
</div>

<?php /*
          <div style="width:100%">
          <?php
          $this->Widget('ext.highcharts.HighchartsWidget', array(
          'options' => array(
          'chart' => array('defaultSeriesType' => 'column'),
          'title' => array('text' => 'Education Non Formal'),
          'xAxis' => array(
          'categories' => gPerson::getUncompleteHoldingCompany(),
          'labels' => array(
          'rotation' => -90,
          'align' => 'right',
          ),
          ),
          'yAxis' => array(
          'title' => array('text' => 'Total')
          ),
          'series' => array(
          array('name' => 'Company', 'data' => gPerson::getUncompleteHolding("educationnf"))
          ),
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
          <br/>
          </div>

          <div style="width:100%">
          <?php
          $this->Widget('ext.highcharts.HighchartsWidget', array(
          'options' => array(
          'chart' => array('defaultSeriesType' => 'column'),
          'title' => array('text' => 'Other Info'),
          'xAxis' => array(
          'categories' => gPerson::getUncompleteHoldingCompany(),
          'labels' => array(
          'rotation' => -90,
          'align' => 'right',
          ),
          ),
          'yAxis' => array(
          'title' => array('text' => 'Total')
          ),
          'series' => array(
          array('name' => 'Company', 'data' => gPerson::getUncompleteHolding("other"))
          ),
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
          <br/>
          </div>
         */
?>
</div>
</div>

