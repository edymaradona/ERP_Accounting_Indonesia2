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
            <h1>Comparison By Department</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', [
                    'options' => [
                        'chart' => ['defaultSeriesType' => 'column'],
                        'title' => ['text' => 'Employee Composition by Department'],
                        'theme' => 'dark-blue',
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
            </div>
            <div class="col-md-6">
                .
            </div>
        </div>

    </div>
</div>

