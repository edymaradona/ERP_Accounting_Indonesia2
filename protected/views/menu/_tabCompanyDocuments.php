<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-flag fa-fw"></i><?php echo Yii::t('basic', ' Company Documents') ?>
        </li>
    </ul>
</div>

<?php
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', [
    'connectorRoute' => 'sCompanyDocuments/connectorCompanyDocuments',
]);
?>

<br/>
