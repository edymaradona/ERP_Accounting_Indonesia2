<?php
$this->breadcrumbs = [
    $model->name,
];

//$this->menu=array(
//		array('label'=>'Home', 'url'=>array('/aOrganization')),
//array('label'=>'Create', 'url'=>array('create')),
//array('label'=>'Update', 'url'=>array('update', 'id'=>$model->id)),
//array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//);
//$this->menu1=aOrganization::getTopUpdated();
//$this->menu2=aOrganization::getTopCreated();
//$this->menu3=aOrganization::getTopRelated($model->id);
?>

<div class="page-header">
    <h1>
        <i class="fa fa-image"></i>
        <?php echo $model->name; ?>
    </h1>
</div>


<?php
$this->widget('booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        //'branch_code',
        'name',
        'address',
        //'address2',
        //'address3',
        //'address4',
        /* 		
          array (
          'label'=>'Kab/Kodya',
          'value'=>sKabupatenPropinsi::model()->findByNull((int)$model->kabupaten_id),
          ),
          array (
          'label'=>'Propinsi',
          'value'=>sKabupatenPropinsi::model()->findByNull((int)$model->propinsi_id),
          ),
         */
        'pos_code',
        'phone_code_area',
        'telephone',
        'fax',
        'email',
        'website',
    ],
]);
?>

