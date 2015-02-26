<?php
$this->breadcrumbs = [
    $this->module->id,
];
?>

<div class="row">
    <div class="col-md-2">
        <?php echo $this->renderPartial('_menuNavigation'); ?>
    </div>

    <div class="col-md-10">
        <div class="page-header">
            <h1>Black List Former Employee</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php $this->renderPartial('_sbBlacklist'); ?>
            </div>
        </div>
    </div>
</div>