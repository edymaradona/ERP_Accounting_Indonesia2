<br/>

<?php

EQuickDlgs::iframeButton(
    [
        'controllerRoute' => 'm1/gPerson/createAssignmentAjax',
        'actionParams' => ['id' => $model->id],
        'dialogTitle' => 'Create New Assignment',
        'dialogWidth' => 800,
        'dialogHeight' => 600,
        'openButtonText' => 'New Assignment',
        // 'closeButtonText' => 'Close',
        'closeOnAction' => true, //important to invoke the close action in the actionCreate
        'refreshGridId' => 'g-karir2-grid', //the grid with this id will be refreshed after closing
        'openButtonHtmlOptions' => ['class' => 'pull-right btn btn-primary'],
    ]
);
?>


<?php echo $this->renderPartial('_tabCareer2', ["model" => $model]); ?>
