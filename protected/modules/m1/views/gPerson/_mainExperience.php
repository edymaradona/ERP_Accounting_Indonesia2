<br/>

<?php

EQuickDlgs::iframeButton(
    [
        'controllerRoute' => 'm1/gPerson/createExperienceAjax',
        'actionParams' => ['id' => $model->id],
        'dialogTitle' => 'Create New Experience',
        'dialogWidth' => 800,
        'dialogHeight' => 600,
        'openButtonText' => 'New Experience',
        // 'closeButtonText' => 'Close',
        'closeOnAction' => true, //important to invoke the close action in the actionCreate
        'refreshGridId' => 'g-person-experience-grid', //the grid with this id will be refreshed after closing
        'openButtonHtmlOptions' => ['class' => 'pull-right btn btn-primary'],
    ]
);
?>

<?php echo $this->renderPartial('_tabExperience', ["model" => $model, "modelExperience" => $modelExperience]); ?>

