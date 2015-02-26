<div style="width:100%">
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
    <br/>

</div>