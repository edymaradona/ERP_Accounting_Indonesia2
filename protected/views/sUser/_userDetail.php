<p>
    <?php
    $un = (isset($model->username)) ? $model->username : "";
    echo CHtml::link('Send Message', Yii::app()->createUrl('mailbox/message/new', ['to' => $un]), ['class' => 'btn btn-xs btn-primary'])
    ?>

</p>
<?php
//$this->widget('booster.widgets.TbDetailView', array(
$this->widget('ext.XDetailView', [
    'ItemColumns' => 1,
    'data' => $model,
    'attributes' => [
        'full_name',
        'username',
        //'password',
        [
            'label' => 'Default Group',
            'value' => aOrganization::model()->findByPk($model->default_group)->name,
        ],
        [
            'label' => 'Status',
            'value' => $model->status->name,
        ],
    ],
]);
?>
<br/>
