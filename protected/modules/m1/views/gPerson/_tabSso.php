<br/>

<div class="alert in alert-block fade alert-info" id="password">
</div>

<?php
$this->widget('booster.widgets.TbDetailView', [
    'id' => 'grid-sso',
    'data' => $model,
    'attributes' => [
        [
            'name' => 'activation_code',
            'visible' => (!isset($model->user)),
        ],
        [
            'name' => 'activation_expire',
            'value' => date("d-m-Y h:i", $model->activation_expire),
            'visible' => (!isset($model->user)),
        ],
        [
            'label' => 'Username',
            'value' => (isset($model->user)) ? $model->user->username : null,
        ],
        [
            'label' => 'Status',
            'value' => (isset($model->user)) ? $model->user->status->name : null,
        ],
    ],
]);
?>
<br/>
<?php
if (!isset($model->user)) {
    echo CHtml::link('Generate Code', Yii::app()->createUrl("/m1/gPerson/updateSso", ["id" => $model->id]), ['class' => 'btn btn-primary']
    );
} else {
    echo CHtml::Ajaxlink('Reset Password', Yii::app()->createUrl("/m1/gPerson/resetSso", ["id" => $model->id, "userid" => $model->userid]), ['update' => '#password'], ['class' => 'btn btn-primary','style'=>'margin-right:10px;']);
    if ($model->user->status_id ==2 ) {
        echo CHtml::Ajaxlink('Set Active ', Yii::app()->createUrl("/m1/gPerson/setActive", ["id" => $model->id, "userid" => $model->userid]), ['update' => '#password'], ['class' => 'btn btn-primary']);
    } else
        echo CHtml::Ajaxlink('Set Non Active ', Yii::app()->createUrl("/m1/gPerson/setActive", ["id" => $model->id, "userid" => $model->userid,"active"=>false]), ['update' => '#password'], ['class' => 'btn btn-primary']);
}
