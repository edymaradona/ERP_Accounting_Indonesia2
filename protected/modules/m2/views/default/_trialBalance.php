<h3>TRIAL BALANCE
    <small><?php echo "Period: " . Yii::app()->params["cCurrentPeriod"] ?> </small>
</h3>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 't-account-balance-grid',
    'dataProvider' => tBalanceSheet::model()->searchTrialBalance(Yii::app()->params["cCurrentPeriod"]),
    'template' => '{pager}{items}{pager}',
    'itemsCssClass' => 'table table-striped table-bordered',
    'columns' => [
        [
            'name' => 'Account Type',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->account->cRoot . "<br/>" .
                    CHtml::tag("div", ["style" => "color: #999; font-size: 11px"], $data->account->getparent->account_concat);
                },
        ],
        [
            'name' => 'account.account_name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->account->account_concat,Yii::app()->createUrl("/m2/tAccount/view",array("id"=>$data->parent_id)))',
        ],
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
        //'user_remark',
    ],
]);
?>

<br/>
