<?php

return [
    'class' => 'booster.widgets.TbMenu',
    'encodeLabel' => false,
    'type' => 'navbar',
    'htmlOptions' => ['class' => 'pull-right'],
    'items' => [
        ['label' => sUser::model()->getFullName() . " " . sNotification::getNotifMessageCount(), 'icon' => 'icon-th', 'url' => '#', 'items' => [
            ['label' => 'Notification' . " " . sNotification::getNotifCount(), 'icon' => 'bookmark', 'url' => Yii::app()->createUrl("sNotification")],
            ['label' => 'Feedback on Forum', 'icon' => 'comment', 'url' => Yii::app()->createUrl("forum")],
            //array('label'=>'Help', 'icon'=>'question-sign','url'=>Yii::app()->createUrl("sAdmin/help")),
            '---',
            ['label' => sUser::model()->myGroupName, 'icon' => 'list', 'url' => Yii::app()->createUrl('/aOrganization/viewSelf', ['id' => sUser::model()->myGroup])],
            ['label' => 'My Profile', 'icon' => 'user', 'url' => Yii::app()->createUrl('/sUser/viewSelf', ['id' => Yii::app()->user->id])],
            ['label' => 'Change User Name', 'icon' => 'user', 'url' => Yii::app()->createUrl('/sUser/updateUsernameAuthenticated', ['id' => Yii::app()->user->id])],
            ['label' => 'Change Password', 'icon' => 'barcode', 'url' => Yii::app()->createUrl('/sUser/updatePasswordAuthenticated', ['id' => Yii::app()->user->id])],
            '---',
            ['label' => 'Photo Gallery', 'icon' => 'picture-o', 'url' => Yii::app()->createUrl('/site/photo')],
            ['label' => 'Company News', 'icon' => 'share', 'url' => Yii::app()->createUrl('/sCompanyNews')],
            ['label' => 'MailBox ' . Mailbox::getMessageCount(), 'icon' => 'envelope', 'url' => Yii::app()->createUrl('/mailbox')],
            //array('label' => 'MailBox', 'icon' => 'envelope', 'url' => Yii::app()->createUrl('/mailbox')),
            '---',
            ['label' => 'User Login History', 'icon' => 'user', 'url' => Yii::app()->createUrl("sNotification/userHistory")],
            ['label' => 'Log Out', 'icon' => 'power-off', 'url' => Yii::app()->createUrl("site/logout")],
        ]],
    ],
];
