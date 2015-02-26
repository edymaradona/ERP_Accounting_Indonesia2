<?php
$this->breadcrumbs = [
    'Employee' => ['index'],
];
?>

<div class="page-header">
    <h1>
        <i class="fa fa-search fa-fw"></i>
        Search (BETA)
    </h1>
</div>

<div class="row">
    <div class="col-md-3">
        <?php $this->renderPartial('_sidebar', ['model' => $model]); ?>
    </div>

    <div class="col-md-9">
        <button id="btn-export" class="btn btn-primary">Export Excel</button>
        <br/><br/>

        <!-- Summary Area -->
        <div class="" id="summary" style="max-height:200px;overflow-y: auto;">
            <span><strong>Summary results</strong></span>
            <hr/>
            <?php $this->renderPartial('_summary'); ?>
        </div>

        <?php
        $assetDir = Yii::app()->createUrl('/shareimage/hr/employee');

        $this->widget('booster.widgets.TbGridView', [
            'id' => 'person-grid',
            'type' => 'striped bordered condensed hover',
            'dataProvider' => $model->getFilter(),
            'columns' => [
                [
                    'header' => 'No.',
                    'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ],
                //'employee_code_global',
                [
                    'header' => 'EMPLOYEE NAME',
                    'type' => 'raw',
                    'value' => function ($data) {
                            return CHtml::tag('div', ['style' => 'font-weight: bold'], CHtml::link($data['employee_name'], Yii::app()->createUrl('m1/gPerson/view', ['id' => $data['id']])))
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data['company']
                                . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data['department'])
                                . $data['job_title'] . $data['level']);
                        },
                    'htmlOptions' => [
                        'style' => 'width:200px;'
                    ]
                ],
                [
                    'header' => 'EMPLOYEE STATUS',
                    'name' => 'employee_status'
                ],
                [
                    'header' => 'JOIN DATE',
                    'name' => 'join_date'
                ],
                [
                    'header' => 'CONTACT',
                    'type' => 'raw',
                    'value' => function ($data) {
                            return CHtml::tag('div', [], $data['email'])
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data['handphone'])
                            . $data['sex'] . ' | ' . $data['religion'];
                        },
                    'htmlOptions' => [
                        'style' => 'width:200px;'
                    ]
                ],
                //                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data['age'] . ' | '

                [
                    'header' => 'FOTO',
                    'type' => 'raw',
                    'value' => function ($data) {
                            return !empty($data['c_pathfoto']) ? CHtml::image(Yii::app()->getBaseUrl(true) . '/shareimages/hr/employee/' . $data['c_pathfoto'], '', ["width" => "70px", "height" => "70px"]) : CHtml::image(Yii::app()->getBaseUrl(true) . '/shareimages/nophoto.jpg', '', ["width" => "70px", "height" => "70px"]);
                        }
                ],
                //'employee_code_global',
                //'company',
                //'company_type',
                //'company_id',
                //'superior_name',
                //'career_status',
                //'employee_status_date',
                //'employee_status_enddate',
                //'join_year',
                //'join_month',
                //'education',
                //'experience',
                //'family',
                //'c_pathfoto',
                //'birth_place',
                //'birth_date',
                //'address1',
                //'identity_address1',
                //'blood_id',
                //'accoount_number',
                //'account_name',
                //'bank_name',
                //'home_phone',
                /*
                  array(
                  'class' => 'booster.widgets.TbButtonColumn',
                  ),
                 *
                 */
            ],
        ]);
        ?>
    </div>
</div>
<style>
    .text_summary {
        visibility: hidden;
        display: none;
        height: 0;
        width: 0;
    }

    *.panel {
        border: 1px solid #eee;
    }

    *
    .panel-body {
        padding: 10px;
    }

    .panel-heading {
        background-color: #eee;
        padding: 10px;
        border-bottom: 1px solid #d0d2d0;
    }

    .panel-heading a {
        padding-left: 5px;
        text-decoration: none;
    }

    .panel-heading a:after {
        /*font-family: 'Glyphicons Halflings';*/
        content: "\e082";
        float: left;
        color: grey;
    }

    .panel-heading a.collapsed:after {
        content: "\e081";
    }
</style>
<?php $this->renderPartial('_scriptFilter'); ?>
