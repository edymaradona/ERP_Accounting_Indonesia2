<?php

if (!Yii::app()->user->isGuest) {
    $this->widget('booster.widgets.TbNavbar', [
        'fixed' => 'bottom',
        'brand' => false,
        'brandUrl' => Yii::app()->createUrl("menu"),
        'collapse' => true, // requires bootstrap-responsive.css
        'items' => [
            [
                'class' => 'booster.widgets.TbMenu',
                'htmlOptions' => ['class' => 'pull-right'],
                'items' => [
                    ['label' => sUser::model()->getFullName(), 'icon' => 'icon-th', 'url' => '#', 'items' => [
                        ['label' => 'Notification', 'icon' => 'bookmark', 'url' => Yii::app()->createUrl("sNotification")],
                        ['label' => 'Feedback', 'icon' => 'comment', 'url' => Yii::app()->createUrl("sFeedback")],
                        //array('label'=>'Help', 'icon'=>'question-sign','url'=>Yii::app()->createUrl("sAdmin/help")),
                        '---',
                        ['label' => sUser::model()->myGroupName, 'icon' => 'list', 'url' => Yii::app()->createUrl('/aOrganization/viewSelf', ['id' => sUser::model()->myGroup])],
                        ['label' => 'My Profile', 'icon' => 'user', 'url' => Yii::app()->createUrl('/sUser/viewSelf', ['id' => Yii::app()->user->id])],
                        ['label' => 'Change User Name', 'icon' => 'barcode', 'url' => Yii::app()->createUrl('/sUser/updateUsernameAuthenticated', ['id' => Yii::app()->user->id])],
                        ['label' => 'Change Password', 'icon' => 'barcode', 'url' => Yii::app()->createUrl('/sUser/updatePasswordAuthenticated', ['id' => Yii::app()->user->id])],
                        '---',
                        ['label' => 'Photo Gallery', 'icon' => 'picture', 'url' => Yii::app()->createUrl('/site/photo')],
                        ['label' => 'Company News', 'icon' => 'share', 'url' => Yii::app()->createUrl('/sCompanyNews')],
                        ['label' => 'MailBox', 'icon' => 'envelope', 'url' => Yii::app()->createUrl('/mailbox')],
                        '---',
                        ['label' => 'Log Out', 'icon' => 'off', 'url' => Yii::app()->createUrl("site/logout")],
                    ]],
                ],
            ],
        ],
    ]);
}
?>
