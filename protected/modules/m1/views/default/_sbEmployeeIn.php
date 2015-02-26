<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Employee In
        </li>
    </ul>
</div>
<?php
$this->widget('booster.widgets.TbGroupGridView', [
    'extraRowColumns' => ['tMonth'],
    'id' => 'employee-grid',
    'dataProvider' => gPersonCareer::model()->employeeIn(),
    'enableSorting' => false,
    'template' => '{items}',
    'htmlOptions' => ['style' => 'padding-top:0'],
    'columns' => [
        [
            'name' => 'tMonth',
            'value' => 'date("M-Y", strtotime($data->start_date))',
            'headerHtmlOptions' => ['style' => 'display: none'],
            'htmlOptions' => ['style' => 'display: none'],
        ],
        [
            'type' => 'raw',
            'value' => '$data->parent->gPersonPhoto',
            'htmlOptions' => ["width" => "55px"],
        ],
        [
            'type' => 'raw',
            'value' => function ($data) {
                    return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->parent->gPersonLink)
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->department->name)
                    . $data->level->name
                    . CHtml::tag('div', ['style' => 'font-weight: bold'], $data->parent->mStatus())
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], (isset($data->parent->companyfirst->start_date)) ? $data->parent->companyfirst->start_date : '')
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->parent->countJoinDate());
                }
        ],
    ],
]);
?>


