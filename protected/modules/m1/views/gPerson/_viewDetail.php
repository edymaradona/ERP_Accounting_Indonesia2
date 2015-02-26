<div class="row">
    <div class="col-md-3">
        <?php
        echo $data->photoPath;
        ?>
        <div style="font-size:11px;">Data<span
                class="pull-right strong"><?php echo peterFunc::indoFormat($data->completion) ?>%</span>
            <?php
            $this->widget('booster.widgets.TbProgress', [
                'context' => 'success', // 'info', 'success' or 'danger'
                'percent' => $data->completion,
                'htmlOptions' => [
                    'style' => 'height:7px;margin-bottom:2px',
                ]
            ]);
            ?>
        </div>

        <?php
        $un = (isset($data->user->username)) ? $data->user->username : "";
        echo CHtml::link('Send Message', Yii::app()->createUrl('mailbox/message/new', ['to' => $un]), ['class' => 'btn btn-default btn-xs btn-block', 'style' => 'margin-bottom:10px;'])
        ?>

        <div class="row">
            <div style="font-size:11px;color:grey;" class="col-md-12 pull-right">
                <?php echo isset($data->updated) ? "Last Updated: " . $data->updated->username : "" ?>
                <br/>
                <?php echo isset($data->user) ? "Last Login: " . peterFunc::nicetime($data->user->last_login) : "Never Login" ?>
            </div>
        </div>

    </div>
    <div class="col-md-9">
        <?php
        $this->widget('booster.widgets.TbDetailView', [
            'data' => [
                'id' => 1,
                'employee_id' => $data->employeeShortId,
                'company' => $data->mCompany(),
                'department' => $data->mDepartment(),
                'job_title' => $data->mJobTitle(),
                'level' => $data->mLevel(),
                'status' => ($data->countContract() != "") ? $data->mStatus() . " " . CHtml::tag('span', ['class' => 'badge badge-warning'], $data->countContract()) : $data->mStatus(),
                'join_date' => (isset($data->companyfirst)) ? $data->companyfirst->start_date . " " . CHtml::tag('span', ['class' => 'badge badge-info'], $data->countJoinDate()) : "",
                'join_dateG' => (isset($data->companyfirstG)) ? $data->companyfirstG->start_date . " " . CHtml::tag('span', ['class' => 'badge badge-info'], $data->countJoinDateG()) : "",
                'join_dateB' => ($data->mJoinTypeId() == 2) ? $data->companycurrent->start_date . " " . CHtml::tag('span', ['class' => 'badge badge-info'], $data->countJoinDateB()) : "",
                'superior' => ($this->id == "gEss") ? $data->mSuperior() : $data->mSuperiorLink(),
                'handphone' => $data->handphone,
                //'email' => $data->cloakEmail . ' ' . $data->isValidEmail,
                'email' => $data->email . ' ' . $data->isValidEmail,
            ],
            'attributes' => [
                ['name' => 'employee_id', 'label' => 'Employee ID'],
                ['name' => 'company', 'label' => 'Company'],
                ['name' => 'department', 'label' => 'Department'],
                ['name' => 'job_title', 'label' => 'Job Title'],
                ['name' => 'level', 'label' => 'Level'],
                ['name' => 'status', 'type' => 'raw', 'label' => 'Status'],
                ['name' => 'join_date', 'type' => 'raw', 'label' => 'Join Date'],
                ['name' => 'join_dateB', 'type' => 'raw', 'label' => 'Join Date Biz Unit', 'visible' => ($data->mJoinTypeId() == 2)],
                ['name' => 'join_dateG', 'type' => 'raw', 'label' => 'Join Date APG', 'visible' => (isset($data->companyfirstG))],
                ['name' => 'superior', 'type' => 'raw', 'label' => 'Superior'],
                ['name' => 'handphone', 'label' => 'Handphone'],
                ['name' => 'email', 'type' => 'email', 'label' => 'Email'],
            ],
        ]);
        ?>
    </div>

</div>
