<?php

$this->widget('booster.widgets.TbExtendedGridView', [
    'id' => 'u-journal-detail-grid',
    'dataProvider' => tJournalDetail::model()->search($data->id),
    'template' => '{items}{pager}',
    'enableSorting' => false,
    'itemsCssClass' => 'table table-striped table-condensed',
    'htmlOptions' => ['style' => 'padding-top:0'],
    'columns' => [
        [
            'name' => 'account_no_id',
            'type' => 'raw',
            'value' => 'CHtml::link($data->account->account_concat,Yii::app()->createUrl("/m2/tAccount/view",array("id"=>$data->account->id)))',
        ],
        [
            'name' => 'currency',
            'value' => '$data->account->cCurrency',
            'footer'=>'Total '
        ],
        //'sub_account_id',
        [
            'class' => 'booster.widgets.TbTotalSumColumn',
            'name' => 'debit',
        ],
        [
            'class' => 'booster.widgets.TbTotalSumColumn',
            'name' => 'credit',
        ],
        /* array(
          'class'=>'ext.gridcolumns.CalcColumn',
          'value'=>'$data->debit+$data->credit',
          'output'=>'peterFunc::indoFormat($value)',
          'footerOutput'=>'peterFunc::indoFormat($value)',
          'type'=>'raw',
          'footer'=>true,
          'htmlOptions'=>array(
          'style'=>'text-align: right; padding-right: 5px;'
          ),
          'footerHtmlOptions'=>array(
          'style'=>'text-align: right; padding-right: 5px;'
          ),
          ), */
        'user_remarkk',
        //'system_remark',
    ],
]);
?>


<?php ?>
