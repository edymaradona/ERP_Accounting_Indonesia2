<div class="row">
    <div class="col-md-6">
        <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i
                        class="fa fa-user fa-fw"></i><?php echo Yii::t('basic', 'Welcome New Employees') ?>
                </li>
            </ul>
        </div>

        <?php
        $this->widget('booster.widgets.TbGridView', [
            'id' => 'employee-grid',
            'dataProvider' => gPersonCareer::model()->employeeInAll(),
            'enableSorting' => false,
            'template' => '{items}',
            'itemsCssClass' => 'table table-striped table-bordered',
            'columns' => [
                [
                    'type' => 'raw',
                    'value' => '$data->parent->photoPath',
                    'htmlOptions' => ["width" => "120px"],
                ],
                [
                    'header' => 'Detail',
                    'type' => 'raw',
                    'value' => function ($data) {
                            return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->parent->employee_name)
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->parent->mCompany())
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->parent->mDepartment())
                            . $data->parent->mLevel()
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], (isset($data->parent->companyfirst->start_date)) ? $data->parent->companyfirst->start_date : '')
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], isset($data->created) ? "last updated by: " . $data->created->username : "");
                        }
                ],
            ],
        ]);
        ?>

    </div>
    <div class="col-md-6">
        <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i
                        class="fa fa-user fa-fw"></i><?php echo Yii::t('basic', 'Employee Career Updated') ?>
                </li>
            </ul>
        </div>

        <?php
        $this->widget('booster.widgets.TbGridView', [
            'id' => 'employee-grid',
            'dataProvider' => gPersonCareer::model()->employeeRecentAll(),
            'enableSorting' => false,
            'template' => '{items}',
            'itemsCssClass' => 'table table-striped table-bordered',
            'columns' => [
                [
                    'type' => 'raw',
                    'value' => '$data->parent->photoPath',
                    'htmlOptions' => ["width" => "120px"],
                ],
                [
                    'header' => 'Detail',
                    'type' => 'raw',
                    'value' => function ($data) {
                            return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->parent->employee_name)
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->parent->mCompany())
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->parent->mDepartment())
                            . $data->parent->mLevel()
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], (isset($data->parent->companyfirst->start_date)) ? $data->parent->companyfirst->start_date : '')
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], isset($data->created) ? "last updated by: " . $data->created->username : "");
                        }
                ],
            ],
        ]);
        ?>

    </div>
</div>

