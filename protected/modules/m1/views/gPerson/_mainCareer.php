<br/>

<?php /*

if (in_array($model->mCompanyId(), sUser::model()->getMyGroupArray()) || Yii::app()->user->name == "admin") {

    EQuickDlgs::iframeButton(
        [
            'controllerRoute' => 'm1/gPerson/createCareerAjax',
            'actionParams' => ['id' => $model->id],
            'dialogTitle' => 'Create New Career',
            'dialogWidth' => 800,
            'dialogHeight' => 600,
            'openButtonText' => 'New Career',
            // 'closeButtonText' => 'Close',
            'closeOnAction' => true, //important to invoke the close action in the actionCreate
            'refreshGridId' => 'g-karir-grid', //the grid with this id will be refreshed after closing
            'openButtonHtmlOptions' => ['class' => 'pull-right btn btn-primary'],
        ]
    );
} */
?>

<?php

echo $this->renderPartial('_tabCareer', ["model" => $model, "modelCareer" => $modelCareer]);

if (in_array($model->mCompanyId(), sUser::model()->getMyGroupArray()) || Yii::app()->user->name == "admin") {
    ?>

    <h4>New Status</h4>

<?php
    //echo $this->renderPartial('_formCareerAjax', array('id' => $model->id, 'model' => $modelCareer));
    echo $this->renderPartial('_formCareer', ['id' => $model->id, 'model' => $modelCareer]);
}
?>