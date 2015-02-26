<?php
$this->breadcrumbs = [
    'Account',
];

$this->menu = [
];

//$this->widget('ext.loading.LoadingWidget');
?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', [
    'id' => 'wait',
    'options' => [
        'title' => 'Closing on Progress',
        'autoOpen' => false,
        'modal' => true,
    ],
]);
echo 'Please Wait...';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', [
    'id' => 'mydialog',
    'options' => [
        'title' => 'Closing Month Process',
        'autoOpen' => false,
        'modal' => true,
        'buttons' => [
            'OK' => 'js:function(){$(this).dialog("close");}',
        ],
    ],
]);
echo 'Process Complete...';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php
Yii::app()->clientScript->registerScript('myCap', "

		$('#myCap').click(function(){
		$.ajax({
		type : 'get',
		url  : $(this).attr('href'),
		data: '',
		success : function(r){
		$('#mydialog').dialog('open');
		$('#periode').text('Current Period: " . peterFunc::cBeginDateAfter(Yii::app()->params["cCurrentPeriod"]) . "');
		//Loading.hide();

}
})
		return false;
});


		");
?>


<div class="page-header">
    <h1>
        Closing Month and Year Period
    </h1>
</div>

<?php
//Yii::app()->settings->set("System", "cCurrentPeriod", 201306, $toDatabase=true);
//Yii::app()->settings->set("System", "cCurrentPeriod", 201307, $toDatabase=true);
//$_nextPeriod = peterFunc::cBeginDateAfter(Yii::app()->params["cCurrentPeriod"]);
//Yii::app()->settings->set("System", "cCurrentPeriod", $_nextPeriod, $toDatabase=true);
?>

<div class="row">
    <div class="col-md-12">
        <h2 id="periode">
            Current Period:
            <?php echo Yii::app()->params["cCurrentPeriod"]; ?>
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <p>When Button "Closing Month Period" executed, it will do this 3
            following steps.</p>

        <p> &#10003; #1. It will check, of any unposted journal on Current Period, will
            marked as Locked</p>

        <p> &#10003; #2. It will move each End-Balance Account on Current Month Period
            and transfer into following Month Period.</p>

        <p> &#10003; #3. Change Current Period into following Month Period. When this
            process done, all existing journal become unavailable to edit and
            delete</p>
    </div>
</div>

<p>
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'link',
        'id' => 'myCap',
        'type' => 'primary',
        'icon' => 'fa fa-check',
        'size' => 'large',
        'url' => Yii::app()->createUrl("/m2/tClosing/closingPeriodExecution"),
        'label' => 'Closing Month Period',
    ]);
    ?>
</p>

<p>
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'link',
        'type' => 'primary',
        'icon' => 'fa fa-check',
        'size' => 'large',
        'url' => Yii::app()->createUrl("/m2/tClosing/closingPeriodExecutionB"),
        'label' => 'Backward Month Period',
    ]);
    ?>
</p>

<br/>

<h2>Unposted Journal</h2>
<?php
//$this->widget('booster.widgets.TbGridView', array(
$this->widget('ext.groupgridview.GroupGridView', [
    'mergeColumns' => ['input_date'],
    'id' => 'u-journal-grid',
    'dataProvider' => tJournal::model()->search(),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'columns' => [
        [
            'class' => 'booster.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m2/tPosting/delete",array("id"=>$data->id))',
            //'template'=>'{delete}{process}',
            /* 			'buttons'=>array
              (
              'process' => array
              (
              //'label'=>'<i class="icon-fa-zoom-in"></i>',
              //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/css/process.png',
              'url'=>'Yii::app()->createUrl("sUser/updatep", array("id"=>$data->id))',
              ),
              ),
             */],
        'input_date',
        'system_ref',
        [
            'header' => 'Module',
            'value' => 'sParameter::item("cModule",$data->module_id)',
        ],
        //'remark',
        //array (
        //	'header'=>'Total item',
        //	'value'=>'$data->journalCount',
        //	'htmlOptions'=>array(
        //		'style'=>'text-align: right; padding-right: 5px;'
        //	),
        //),
        [
            'header' => 'Status',
            'value' => '$data->status->name',
        ],
        [
            'header' => 'Total',
            'type' => 'number',
            'value' => '$data->journalSum',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
    ],
]);
?>
