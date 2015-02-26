<?php

$form = $this->beginWidget('TbActiveForm', [
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => ['class' => 'form-inline'],
]);
?>

<?php

$this->widget('zii.widgets.jui.CJuiAutoComplete', [
    'model' => $model,
    'attribute' => 'system_ref',
    'source' => $this->createUrl('/m2/tPosting/postingAutoComplete'),
    'options' => [
        'minLength' => '2',
        //'select'=>'js:function( event, ui ) {
        //	window.open("'.$this->createUrl('/m2/tAccount/index',array("tAccount[account_name]"=>"penj","q"=>"Search")).'","_self");
        //	return false;
        //}',
        //'select'=>'js:function( event, ui ) {
        //	alert("Testing: "+'.time().');
        //	return false;
        //}',
    ],
    'htmlOptions' => [
        'class' => 'form-control blocked',
        'placeholder' => 'Search NoRef or Remark',
    ],
]);
?>

<?php //echo CHtml::htmlButton('<i class="icon-fa-search"></i>Search', array('class' => 'btn', 'type' => 'submit')); ?>

<?php $this->endWidget(); ?>

<br/>
