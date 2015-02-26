<?php /*
  EQuickDlgs::ajaxButton(
  array(
  'controllerRoute' => 'm1/gPerson/createStatusAjax',
  'actionParams' => array('id'=>$model->id),
  'dialogTitle' => 'Create New Status',
  'dialogWidth' => 800,
  'dialogHeight' => 600,
  'openButtonText' => 'New Status',
  // 'closeButtonText' => 'Close',
  'closeOnAction' => true, //important to invoke the close action in the actionCreate
  'refreshGridId' => 'g-person-status-grid', //the grid with this id will be refreshed after closing
  'openButtonHtmlOptions' => array('class'=>'pull-right btn btn-primary'),
  )
  );

 */
?>

<?php
echo $this->renderPartial('_tabStatus', ["model" => $model, "modelStatus" => $modelStatus]);

if (in_array($model->mCompanyId(), sUser::model()->getMyGroupArray()) || Yii::app()->user->name == "admin") {
    ?>

    <h4>New Status</h4>

<?php
//echo $this->renderPartial('_formStatusAjax', array('id' => $model->id, 'model' => $modelStatus));
    echo $this->renderPartial('_formStatus', ['id' => $model->id, 'model' => $modelStatus]);
}
?>