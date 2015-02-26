<?php
$this->breadcrumbs = [
    'Journal Voucher',
];

$this->menu = [
    //array('label'=>'Home', 'icon'=>'home','url'=>array('/m2/tJournal')),
];


$this->menu1 = tJournal::getTopUpdated(1);
$this->menu2 = tJournal::getTopCreated(1);
$this->menu5 = ['Journal'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m2/tJournal/index')];
?>
<div class="page-header">
    <h1>
        Journal Voucher
    </h1>
</div>

<?php
$this->widget('booster.widgets.TbListView', [
    'dataProvider' => $dataProvider,
    'template' => '{items}{pager}',
    'itemView' => '/tJournal/_view',
    'htmlOptions' => [
        'style' => 'padding-top:0',
    ]
]);
?>

