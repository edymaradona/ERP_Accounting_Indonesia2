<?php
$this->breadcrumbs = [
    'Purchase Order',
];

$this->menu = [
    ['label' => 'Create PO Dept', 'url' => ['createDept']],
    //array('label'=>'Create Simple PO', 'url'=>array('create')),
];

$this->menu1 = aPorder::getTopUpdated();
$this->menu2 = aPorder::getTopCreated();
$this->menu5 = ['Simple PO'];
?>

    <div class="page-header">
        <h1>
            <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/cash.png') ?>
            Purchase Order:
            <?php
            if ($id == 1)
                echo "Pending";
            elseif ($id == 2)
                echo "UnPaid";
            else
                "";
            ?>
        </h1>
    </div>

<?php
$this->widget('booster.widgets.TbMenu', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => [
        ['label' => 'Waiting for Approval', 'url' => Yii::app()->createUrl('/m3/aPorder', ["id" => 1]), 'active' => ($id == 1)],
        ['label' => 'Waiting for Payment', 'url' => Yii::app()->createUrl('/m3/aPorder', ["id" => 2]), 'active' => ($id == 2)],
        ['label' => 'Paid', 'url' => Yii::app()->createUrl('/m3/aPorder', ["id" => 3]), 'active' => ($id == 3)],
        ['label' => 'Show All', 'url' => Yii::app()->createUrl('/m3/aPorder', ["id" => 0]), 'active' => ($id == 0)],
    ],
]);
?>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'aPorder-grid',
    'dataProvider' => aPorder::model()->search($id),
    //'filter'=>$model,
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'columns' => [
        [
            'class' => 'TbButtonColumn',
            'template' => '{print}',
            'buttons' => [
                'print' => [
                    'label' => 'Print',
                    //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/process.png',
                    'url' => 'Yii::app()->createUrl("/m3/aPorder/report1", array("id"=>$data->id))',
                    'options' => [
                        'class' => 'btn btn-mini',
                    ],
                ],
            ],
        ],
        [
            'header' => 'For Department',
            'value' => '$data->organization->name',
            'visible' => Yii::app()->user->name == "admin",
        ],
        'input_date',
        [
            'name' => 'no_ref',
            'type' => 'raw',
            'value' => 'CHtml::link($data->no_ref,Yii::app()->createUrl("/m3/aPorder/view",array("id"=>$data->id)))',
        ],
        'periode_date',
        [
            'header' => 'Main Category',
            'value' => '$data->budgetcomp->getCodeName()',
        ],
        //'remark',
//array(
        //	'header'=>'Paid By',
        //	'name'=>'issuer.name',
        //),
//'payment.name',
        [
            'header' => 'Total',
            'value' => '$data->sum_pof()',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        'approved_date',
        'payment_date',
        [
            'class' => 'TbButtonColumn',
            'template' => '{myView}{myUpdate}',
            'buttons' => [
                'myView' => [
                    'label' => '<i class="icon-fa-zoom-in"></i>',
                    //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/detail.png',
                    'url' => '$this->grid->controller->createUrl("/m3/aPorder/view", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open"); return false;}',
                ],
                'myUpdate' => [
                    'label' => '<i class="icon-fa-pencil"></i>',
                    //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/edit.png',
                    'url' => 'Yii::app()->createUrl("/m3/aPorder/update", array("id"=>$data->id))',
                ],
            ],
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonLabel' => '<i class="icon-fa-trash"></i>',
            'deleteButtonImageUrl' => false,
            'visible' => ($id == 1),
        ],
    ],
]);
?>

<?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', [
    'id' => 'cru-dialog',
    'options' => [
        'title' => 'View Detail',
        'autoOpen' => false,
        'modal' => true,
        'width' => '70%',
        'height' => '500',
    ],
]);
?>
    <iframe id="cru-frame" width="100%" height="100%"></iframe>
<?php
$this->endWidget();
//--------------------- end new code --------------------------
?><?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', [
    'id' => 'mydialog',
    'options' => [
        'title' => 'Payment Process',
        'autoOpen' => false,
        'modal' => true,
    ],
]);
echo 'Posting Complete...';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>