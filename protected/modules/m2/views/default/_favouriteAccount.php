<h3>Favourite Account
    <small><?php echo "Period: " . Yii::app()->params["cCurrentPeriod"] ?> </small>
</h3>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 't-account-balance-grid',
    'dataProvider' => tBalanceSheet::model()->searchFavouriteAccount(Yii::app()->params["cCurrentPeriod"]),
    'template' => '{pager}{items}{pager}',
    'itemsCssClass' => 'table table-condensed ',
    'columns' => [
        [
            'name' => 'Account Type',
            'type' => 'raw',
            'value' => function ($data) {
                    return
                        CHtml::link($data['account_name'], Yii::app()->createUrl("/m2/tAccount/view", ["id" => $data['parent_id']]));
                },
        ],
        [
            'header' => 'Begin',
            'value' => 'peterFunc::indoFormat($data["beginning_balance"])',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => 'debit',
            'value' => 'peterFunc::indoFormat($data["debit"])',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'name' => 'credit',
            'value' => 'peterFunc::indoFormat($data["credit"])',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'header' => 'End',
            'value' => 'peterFunc::indoFormat($data["end_balance"])',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        //'created_date',
        //'user_remark',
    ],
]);
?>

<br/>
