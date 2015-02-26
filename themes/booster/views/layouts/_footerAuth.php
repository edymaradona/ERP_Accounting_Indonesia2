<footer style="background-color:black;margin-top:50px;">
    <div class="container">
        <div style="font-size:12px;margin-top:20px;color:white">
            <div class="row">
                <div class="col-md-4">
                    <ul class="unstyled" style="margin-left:10px">
                        <p><strong>General</strong></p>
                        <li>
                            <i class="fa fa-bookmark fa-fw"></i><?php echo CHtml::link(' Notification', Yii::app()->createUrl('/sNotification'), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-comment fa-fw"></i><?php echo CHtml::link(' Feedback', Yii::app()->createUrl('/sFeedback'), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-picture-o fa-fw"></i><?php echo CHtml::link(' Photo Gallery', Yii::app()->createUrl('/site/photo'), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-share fa-fw"></i><?php echo CHtml::link(' Company News', Yii::app()->createUrl('/sCompanyNews'), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i><?php echo CHtml::link(' Mailbox', Yii::app()->createUrl('/mailbox'), ["style" => "color: white"]) ?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="unstyled" style="margin-left:10px">
                        <p><strong>Employee Self Service</strong></p>
                        <li>
                            <i class="fa fa-leaf fa-fw"></i><?php echo CHtml::link(' ESS Dashboard', Yii::app()->createUrl('/m1/gEss'), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-user fa-fw"></i><?php echo CHtml::link(' My Profile', Yii::app()->createUrl('/m1/gEss/person'), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-plane fa-fw"></i><?php echo CHtml::link(' My Leave', Yii::app()->createUrl('/m1/gEss/leave'), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-hand-o-up fa-fw"></i><?php echo CHtml::link(' Permission', Yii::app()->createUrl('/m1/gEss/permission'), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-bell fa-fw"></i><?php echo CHtml::link(' Attendance', Yii::app()->createUrl('/m1/gEss/attendance'), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-medkit fa-fw"></i><?php echo CHtml::link(' Medical', Yii::app()->createUrl('/m1/gEss/medical'), ["style" => "color: white"]) ?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="unstyled" style="margin-left:10px">
                        <p><strong>Profile</strong></p>
                        <li>
                            <i class="fa fa-list fa-fw"></i><?php echo CHtml::link(" " . sUser::model()->myGroupName, Yii::app()->createUrl('/aOrganization/viewSelf', ['id' => sUser::model()->myGroup]), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-user fa-fw"></i><?php echo CHtml::link(' My Profile', Yii::app()->createUrl('/sUser/viewSelf', ['id' => Yii::app()->user->id]), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-user fa-fw"></i><?php echo CHtml::link(' Change User Name', Yii::app()->createUrl('/sUser/updateUsernameAuthenticated', ['id' => Yii::app()->user->id]), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-barcode fa-fw"></i><?php echo CHtml::link(' Change Password', Yii::app()->createUrl('/sUser/updatePasswordAuthenticated', ['id' => Yii::app()->user->id]), ["style" => "color: white"]) ?>
                        </li>
                        <li>
                            <i class="fa fa-user fa-fw"></i><?php echo CHtml::link(' User Login History', Yii::app()->createUrl('/sNotification/userHistory'), ["style" => "color: white"]) ?>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <?php echo CHtml::link('Term and Conditions of Use', Yii::app()->createUrl('site/link', ['view' => 'tac'])) ?>
                    | <?php echo CHtml::link('Privacy Policy', Yii::app()->createUrl('site/link', ['view' => 'policy'])) ?>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <p class="muted pull-right" style="color:white;">
                        <?php echo Yii::app()->params['title'] ?> :: Ver <?php echo Yii::app()->params['appVersion'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
</footer>
