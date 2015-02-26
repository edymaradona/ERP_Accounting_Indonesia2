<?php
$this->breadcrumbs = [
    $model->username,
];
?>

<div class="page-header">
    <h1>
        <i class="fa fa-user fa-fw"></i>
        <?php echo CHtml::encode($model->username); ?>
    </h1>
</div>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Update User Name', 'url' => Yii::app()->createUrl('/sUser/updateUsernameAuthenticated', ["id" => $model->id])],
        ['label' => 'Update Password', 'url' => Yii::app()->createUrl('/sUser/updatePasswordAuthenticated', ["id" => $model->id])],
    ],
    'htmlOptions' => [

    ]
]);
?>

<br/>

<?php echo $this->renderPartial('_userDetail', ['model' => $model]); ?>

<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-camera fa-fw"></i>Personal Folder
        </li>
    </ul>
</div>


<?php
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', [
        'connectorRoute' => 'sCompanyDocuments/connectorPersonalDocuments',
    ]
);
?>
