<div style="width:100%">
    <?php
    $this->Widget('ext.highcharts.HighchartsWidget', [
        'options' => [
            'chart' => ['defaultSeriesType' => 'column'],
            'title' => ['text' => 'Employee Composition by Department'],
            'xAxis' => [
                'categories' => aOrganization::compDeptGroup(),
                'labels' => [
                    'rotation' => -90,
                    'align' => 'right',
                ],
            ],
            'yAxis' => [
                'title' => ['text' => 'Total']
            ],
            'series' => [
                ['name' => 'Department', 'data' => gPerson2::compDepartment()]
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