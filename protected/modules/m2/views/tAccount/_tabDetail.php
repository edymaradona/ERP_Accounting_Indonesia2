<?php
if ($model->haschild) {
    ?>

    <h3>Child Account</h3>
    <?php
    $this->widget('booster.widgets.TbGridView', [
        'id' => 't-account-child-grid',
        'dataProvider' => tAccount::model()->search($model->id),
        'itemsCssClass' => 'table table-striped table-bordered',
        'template' => '{items}{pager}',
        'columns' => [
            [
                'name' => 'account_no',
                'type' => 'raw',
                'value' => 'CHtml::link($data->account_concat,Yii::app()->createUrl("/m2/tAccount/view",array("id"=>$data->id)))',
            ],
            [
                'name' => 'haschild_id',
                'type' => 'raw',
                'value' => '$data->haschildIsInherited',
            ],
            [
                'header' => 'Account Type',
                'value' => '$data->cRoot',
            ],
            [
                'header' => 'Currency',
                'value' => '$data->cCurrency',
            ],
            [
                'header' => 'Status',
                'value' => '$data->cState',
            ],
        ],
    ]);
    ?>

<?php
}
?>

<?php /*
  <h3>Sibling Account</h3>
  <?php
  $this->widget('booster.widgets.TbGridView', array(
  'id' => 't-account-sibling-grid',
  'dataProvider' => tAccount::model()->searchSibling($model->parent_id, $model->id),
  'itemsCssClass' => 'table table-striped table-bordered',
  'template' => '{items}{pager}',
  'columns' => array(
  array(
  'name' => 'account_no',
  'type' => 'raw',
  'value' => 'CHtml::link($data->account_concat,Yii::app()->createUrl("/m2/tAccount/view",array("id"=>$data->id)))',
  ),
  array(
  'name' => 'haschild_id',
  'value' => '$data->haschildIsInherited',
  ),
  array(
  'header' => 'Type Account',
  'value' => '$data->cRoot',
  ),
  array(
  'header' => 'Currency',
  'value' => '$data->cCurrency',
  ),
  array(
  'header' => 'Status',
  'value' => '$data->cState',
  ),
  ),
  ));
  ?>
 */
?>

<?php
if ($model->haschild) {
    ?>

    <h3>New Account</h3>
    <?php echo $this->renderPartial('_form', ['model' => $modelAccount]); ?>

<?php
}
?>




