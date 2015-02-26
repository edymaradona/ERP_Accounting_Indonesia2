<h3>Balance Sheet</h3>
<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 't-account-balance-sum-grid',
    'dataProvider' => tBalanceSheet::model()->search($model->id),
    'template' => '{items}{pager}',
    'itemsCssClass' => 'table table-striped table-bordered',
    'columns' => [
        [
            'name' => 'type_balance_id',
            'value' => 'sParameter::item("cBalanceType",$data->type_balance_id)',
        ],
        'yearmonth_periode',
        //array(
        //	'name'=>'budget',
        //	'htmlOptions'=>array(
        //		'style'=>'text-align: right; padding-right: 5px;'
        //	),
        //),
        [
            'name' => 'beginning_balance',
            'value' => 'peterFunc::indoFormat($data->beginning_balance)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => 'debit',
            'value' => 'peterFunc::indoFormat($data->debit)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => 'credit',
            'value' => 'peterFunc::indoFormat($data->credit)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => 'end_balance',
            'value' => 'peterFunc::indoFormat($data->end_balance)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        /*        array(
          'class' => 'EJuiDlgsColumn',
          'template' => '{update}',
          'updateDialog' => array(
          'controllerRoute' => 'm2/tAccount/updateBalance',
          'actionParams' => array('id' => '$data->id'),
          'dialogTitle' => 'Update Balance',
          'dialogWidth' => 512, //override the value from the dialog config
          'dialogHeight' => 530
          ),
          ),
         */
    ],
]);
?>

<br>

<h3>Journal List</h3>

<?php
$this->widget('booster.widgets.TbGridView', [
//$this->widget('ext.groupgridview.GroupGridView', array(
    //		'mergeColumns' => array('journal.input_date'),
    'id' => 't-account-balance-grid',
    'dataProvider' => tJournalDetail::model()->searchByAccount($model->id),
    'template' => '{pager}{items}{pager}',
    'itemsCssClass' => 'table table-striped table-bordered',
    'columns' => [
        [
            'header' => 'Tanggal',
            'name' => 'journal.input_date',
            'value' => '$data->journal->input_date',
        ],
        [
            'header' => 'Entity',
            'value' => '$data->journal->entity->branch_code',
        ],
        [
            'header' => 'No Ref',
            'type' => 'raw',
            'value' => '$data->journal->linkUrl',
        ],
        [
            'name' => 'debit',
            'value' => 'peterFunc::indoFormat($data->debit)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => 'credit',
            'value' => 'peterFunc::indoFormat($data->credit)',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        'user_remark',
    ],
]);
?>

<br/>

