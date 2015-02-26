<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Employee Out
        </li>
    </ul>
</div>

<?php
$this->widget('booster.widgets.TbGroupGridView', [
    'extraRowColumns' => ['tMonth'],
    'id' => 'employee-grid',
    'dataProvider' => gPerson2::employeeOut(),
    'template' => '{items}',
    'enableSorting' => false,
    'htmlOptions' => ['style' => 'padding-top:0'],
    'columns' => [
        [
            'name' => 'tMonth',
            'value' => 'date("M-Y", strtotime($data->status->start_date))',
            'headerHtmlOptions' => ['style' => 'display: none'],
            'htmlOptions' => ['style' => 'display: none'],
        ],
        [
            'type' => 'raw',
            'value' => '$data->gPersonPhoto',
            'htmlOptions' => ["width" => "55px"],
        ],
        [
            'type' => 'raw',
            'value' => function ($data) {
                    return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->gPersonLink)
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->mDepartment())
                    . $data->mLevel()
                    . "</br>"
                    . $data->company->start_date
                    . " to "
                    . $data->status->start_date;
                }
        ],
    ],
]);
?>
