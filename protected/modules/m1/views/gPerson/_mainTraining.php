<br/>
<h4>Holding Training</h4>

<?php echo $this->renderPartial('/gPerson/_tabTrainingHolding', ["model" => $model]); ?>

<br/>

<?php
if ($this->id == "gPerson") {
    EQuickDlgs::iframeButton(
        [
            'controllerRoute' => 'm1/gPerson/createTrainingAjax',
            'actionParams' => ['id' => $model->id],
            'dialogTitle' => 'Create New Training',
            'dialogWidth' => 800,
            'dialogHeight' => 600,
            'openButtonText' => 'New Training',
            // 'closeButtonText' => 'Close',
            'closeOnAction' => true, //important to invoke the close action in the actionCreate
            'refreshGridId' => 'gperson-training-nf-grid', //the grid with this id will be refreshed after closing
            'openButtonHtmlOptions' => ['class' => 'pull-right btn btn-primary'],
        ]
    );
}
?>

<h4>Local Training</h4>
<?php echo $this->renderPartial('/gPerson/_tabTraining', ["model" => $model]); ?>

