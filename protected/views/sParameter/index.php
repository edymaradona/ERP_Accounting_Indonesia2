<?php
$this->breadcrumbs = [
    'Parameter' => ['index'],
    'Manage',
];

Yii::app()->clientScript->registerScript('sel_status', "
        $('#selStatus').change(function() {
            //alert(this.value);
            $.fn.yiiGridView.update('parameter-grid', {
                    data: $(this).serialize()
            });            
            return false;
        });
    ");

?>

<div class="page-header">
    <h1><i class="fa fa-flask fa-fw"></i>
        Data Parameter</h1>
</div>
<?php
$this->widget('DropDownRedirect', [
    'data' => sParameter::items3("Any"),
    'url' => $this->createUrl($this->route, array_merge($_GET, ['type' => '__value__'])),
    'select' => (isset($_GET['type'])) ? $_GET['type'] : "(ALL)",
    'htmlOptions'=>[
        'class'=>'form-control',
    ]
]);

/*
$data = CHtml::listData(sParameter::items3("Any"), 'type', 'Type');

$select = key($data);

echo CHtml::dropDownList(
    'dropDownStatus',
    $select, // selected item from the $data
    sParameter::items3("Any"),
    [
        'style' => 'margin-bottom:10px;',
        'id' => 'selStatus',
        'class'=>'form-control',
    ]
);
*/
?>

<?php
$this->widget('booster.widgets.TbGroupGridView', [
    'extraRowColumns' => ['type'],
    'id' => 'parameter-grid',
    'dataProvider' => sParameter::model()->search($type),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => [
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/sParameter/delete",array("pk1"=>$data->type,"pk2"=>$data->code))',
            'updateDialog' => [
                'controllerRoute' => 'sParameter/update',
                'actionParams' => ['pk1' => '$data->type', 'pk2' => '$data->code', 'asDialog' => 1, 'gridId' => '$this->grid->id'],
                'dialogTitle' => 'Update Parameter',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
        'code',
        'name',
        'status.name',
    ],
]);
?>

<hr/>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => [
        ['label' => 'Existing Parameter', 'content' => $this->renderPartial("_formE", ["model" => $modelParameter], true), 'active' => true],
        ['label' => 'New Parameter', 'content' => $this->renderPartial("_form", ["model" => $modelParameter], true)],
    ],
]);
?>

<?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', [
    'id' => 'cru-dialog',
    'options' => [
        'title' => 'Update Detail',
        'autoOpen' => false,
        'modal' => true,
        'width' => '70%',
        'height' => '550',
    ],
]);
?>

<iframe id="cru-frame"
        width="100%" height="100%">
</iframe>
<?php
$this->endWidget();
//--------------------- end new code --------------------------
?>

