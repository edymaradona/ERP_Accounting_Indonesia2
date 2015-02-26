<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-reorder"></i>
            <?php
            $unread = (sNotification::model()->unreadCount != 0) ? CHtml::tag("span", ['style' => 'font-size:inherit', 'class' => 'badge badge-info'], sNotification::model()->unreadCount) : "";
            echo " Notifications System " . $unread;
            ?></li>
    </ul>
</div>

<ul>
    <?php
    $notifiche = sNotification::getUnreadNotifications();

    foreach ($notifiche as $notifica) {
        echo CHtml::openTag('div', ['class' => 'media', 'style' => 'margin-top:0;']);
        echo CHtml::openTag('p', ['class' => 'pull-left', 'style' => 'width:30px']);
        echo $notifica->photoPath;
        echo CHtml::closeTag('p');

        echo CHtml::openTag('div', ['class' => 'media-body']);
        echo CHtml::openTag('p', ['class' => 'media-heading']);
        //echo CHtml::link($notifica->content, Yii::app()->createUrl('/sNotification/read', array('id' => $notifica->id)));
        echo $notifica->linkReplace;
        echo CHtml::tag('i', ['style' => 'color:grey;font-size:11px; margin-bottom:10px;'], '  (' . peterFunc::nicetime($notifica->expire) . ' by ' . $notifica->author_name . ')');
        echo CHtml::closeTag('p');
        echo CHtml::closeTag('div');
        echo CHtml::closeTag('div');
    }
    ?>
</ul>

<div class="pull-right">
    <p>
        <strong><?php echo CHtml::link('<i class="fam-add"></i>Notification Index', Yii::app()->createUrl('/sNotification')); ?></strong>
    </p>
</div>

<br/>


