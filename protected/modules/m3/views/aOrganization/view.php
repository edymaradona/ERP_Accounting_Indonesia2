<?php
$this->breadcrumbs = [
    $model->name,
];

$this->menu = [
    ['label' => 'Home', 'url' => ['/m3/aOrganization']],
    ['label' => 'Create', 'url' => ['create']],
    ['label' => 'Update', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
];

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
$this->menu3 = aOrganization::getTopRelated($model->id);
?>

    <div class="page-header">
        <h1>
            <?php echo $model->name; ?>
        </h1>
    </div>


<?php
$this->widget('booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        //'branch_code',
        'name',
        //'address',
        //'address2',
        //'address3',
        //'address4',
        /* 		array (
          'label'=>'Kab/Kodya',
          'value'=>sKabupatenPropinsi::model()->findByNull((int)$model->kabupaten_id),
          ),
          array (
          'label'=>'Propinsi',
          'value'=>sKabupatenPropinsi::model()->findByNull((int)$model->propinsi_id),
          ),
         */ //'pos_code',
        //		'phone_code_area',
        //		'telephone',
        //		'fax',
        //		'email',
        //		'website',
    ],
]);
?>

<?php /*
  <h2>Account Behalf of This Entity</h2>
  <?php $this->widget('booster.widgets.TbGridView', array(

  'id'=>'t-account-grid',
  'dataProvider'=>tAccountEntity::model()->searchEntity($model->id),
  'itemsCssClass'=>'table table-striped table-bordered',
  'template'=>'{items}{pager}',
  'columns'=>array(
  array(
  'header'=>'Account',
  'type'=>'raw',
  'value'=>'CHtml::link($data->account->account_concat(),Yii::app()->createUrl("/m3/tAccount/view",array("id"=>$data->parent_id)))',
  ),
  array(
  'header'=>'Type Account',
  'name'=>'haschild_id',
  'value'=>'$data->account->getRoot()',
  ),
  array(
  'header'=>'Currency',
  'name'=>'currency_id',
  'value'=>'$data->account->getCurrency()',
  ),
  array (
  'header'=>'Status',
  'name'=>'state_id',
  'value'=>'$data->account->getState()',
  ),
  ),
  )); ?>

 */
?>