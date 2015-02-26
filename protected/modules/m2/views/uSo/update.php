<?php
$this->breadcrumbs = [
    'U Sos' => ['index'],
    //$model->id=>array('view','id'=>$model->system_ref),
    'Update',
];


$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/uSo']],
    //array('label'=>'View', 'icon'=>'edit', 'url'=>array('view','id'=>$model->id)),
    //array('label'=>'Delete','icon'=>'trash', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
];

$this->menu5 = ['Sales Order'];

$this->menu1 = uSo::getTopUpdated();
$this->menu2 = uSo::getTopCreated();

//$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m2/uSo/index'));
?>


    <div class="page-header">
        <h1>Update</h1>
    </div>


<?php echo $this->renderPartial('_form', ['model' => $model]); ?>