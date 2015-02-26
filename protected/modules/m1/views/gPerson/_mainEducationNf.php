<br/>

<?php

EQuickDlgs::iframeButton(
    [
        'controllerRoute' => 'm1/gPerson/createEducationNfAjax',
        'actionParams' => ['id' => $model->id],
        'dialogTitle' => 'Create New Education Non Formal',
        'dialogWidth' => 800,
        'dialogHeight' => 600,
        'openButtonText' => 'New Education Non Formal',
        // 'closeButtonText' => 'Close',
        'closeOnAction' => true, //important to invoke the close action in the actionCreate
        'refreshGridId' => 'gperson-education-nf-grid', //the grid with this id will be refreshed after closing
        'openButtonHtmlOptions' => ['class' => 'pull-right btn btn-primary'],
    ]
);
?>

<?php echo $this->renderPartial('_tabEducationNf', ["model" => $model, "modelEducationNf" => $modelEducationNf]); ?>

