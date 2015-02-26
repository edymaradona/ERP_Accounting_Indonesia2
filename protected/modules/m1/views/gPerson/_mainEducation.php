<?php /*
  EQuickDlgs::iframeButton(
  array(
  'controllerRoute' => 'm1/gPerson/createEducationAjax',
  'actionParams' => array('id'=>$model->id),
  'dialogTitle' => 'Create New Education',
  'dialogWidth' => 800,
  'dialogHeight' => 600,
  'openButtonText' => 'New Education',
  // 'closeButtonText' => 'Close',
  'closeOnAction' => true, //important to invoke the close action in the actionCreate
  'refreshGridId' => 'gperson-education-grid', //the grid with this id will be refreshed after closing
  'openButtonHtmlOptions' => array('class'=>'pull-right btn btn-primary'),
  )
  );
 */
?>

<?php echo $this->renderPartial('_tabEducation', ["model" => $model, "modelEducation" => $modelEducation]); ?>

    <h4>New Education</h4>

<?php
echo $this->renderPartial('_formEducation', ['model' => $modelEducation]);
