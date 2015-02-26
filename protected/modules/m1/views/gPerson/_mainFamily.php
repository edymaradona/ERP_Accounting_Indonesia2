<br/>

<?php

EQuickDlgs::iframeButton(
    [
        'controllerRoute' => 'm1/gPerson/createFamilyAjax',
        'actionParams' => ['id' => $model->id],
        'dialogTitle' => 'Create New Family',
        'dialogWidth' => 800,
        'dialogHeight' => 600,
        'openButtonText' => 'New Family',
        // 'closeButtonText' => 'Close',
        'closeOnAction' => true, //important to invoke the close action in the actionCreate
        'refreshGridId' => 'g-person-family-grid', //the grid with this id will be refreshed after closing
        'openButtonHtmlOptions' => ['class' => 'pull-right btn btn-primary'],
    ]
);
?>


<?php echo $this->renderPartial('_tabFamily', ["model" => $model, "modelFamily" => $modelFamily]); ?>

