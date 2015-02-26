<?php
/* @var $this SUserSController */
/* @var $data sUser */
?>

<div class="row">
    <div class="col-md-12">
        <h4><?php echo CHtml::link($data->username, Yii::app()->createUrl('/sUser/view', ['id' => $data->id])); ?>
            | <?php echo CHtml::link('rights', Yii::app()->createUrl('/rights/assignment/user', ['id' => $data->id])); ?>
            <small><?php echo peterFunc::nicetime($data->last_login); ?></small>
        </h4>
        <?php
        $this->widget('booster.widgets.TbDetailView', [
            'data' => [
                'id' => 1,
                'full_name' => $data->full_name,
                'sso' => CHtml::link($data->sso(), Yii::app()->createUrl('m1/gPerson/view', ['id' => $data->ssoId()])),
                'module' => implode(" | ", $data->moduleMember),
                'right' => implode(" | ", $data->rightMember),
                'groupmember' => implode(" | ", $data->myGroupMember),
                'status' => $data->status->name,
            ],
            'attributes' => [
                ['name' => 'full_name', 'label' => 'Full Name'],
                ['name' => 'sso', 'type' => 'raw', 'label' => 'SSO'],
                ['name' => 'module', 'label' => 'Module List ' . CHtml::tag("span", ['class' => 'badge badge-info pull-right'], $data->moduleCount)],
                ['name' => 'right', 'label' => 'Right List ' . CHtml::tag("span", ['class' => 'badge badge-info pull-right'], $data->rightCount)],
                ['name' => 'groupmember', 'label' => 'Group Member ' . CHtml::tag("span", ['class' => 'badge badge-info pull-right'], $data->groupCount + 1)],
                ['name' => 'status', 'label' => 'Status'],
            ],
        ]);
        ?>
    </div>
</div>

<br/>
