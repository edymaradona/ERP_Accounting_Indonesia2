<div class="row">
    <div class="col-md-6 hidden-sm hidden-xs">
        <?php
        if (Yii::app()->user->name != "koes" && (Yii::app()->user->name == "admin" || Yii::app()->user->checkAccess('HR Unit Staff') || Yii::app()->user->checkAccess('HR Holding Staff')))
            $this->renderPartial("_reminderSystem");
        ?>
    </div>
    <div class="col-md-6">
        <?php
        if (Yii::app()->user->name == "admin" || Yii::app()->user->checkAccess('HR Unit Staff'))
            $this->renderPartial("_notificationSystem");
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 hidden-sm hidden-xs">
        <?php
        if (Yii::app()->user->name != "koes" && (Yii::app()->user->name == "admin"  || Yii::app()->user->checkAccess('HR Unit Staff') || Yii::app()->user->checkAccess('HR Holding Staff')))
            $this->renderPartial("_tabApprovedLeave");
        ?>
    </div>
    <div class="col-md-12 hidden-sm hidden-xs">
        <?php
        if (Yii::app()->user->name != "koes" && (Yii::app()->user->name == "admin"  || Yii::app()->user->checkAccess('HR Unit Staff') || Yii::app()->user->checkAccess('HR Holding Staff')))
            $this->renderPartial("_tabApprovedPermission");
        ?>
    </div>
</div>


<?php
$this->renderPartial("_tabAnnouncement");

$isExist = is_file(Yii::app()->basePath . "/modules/m1/models/gPerson.php");
if ($isExist) {
    if (Yii::app()->user->name == "admin")
        $this->renderPartial("_tabNewEmployee");
}

//echo $this->renderPartial("_tabMailbox", array(), true);
//$this->renderPartial("_tabCompanyDocuments");
$this->renderPartial("_tabCompanyDocumentsNew");
?>

