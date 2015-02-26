<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-bars fa-fw"></i>
            <?php
            echo " Notifications System " . sNotification::getNotifCount();
            ?></li>
    </ul>
</div>

<div style="overflow: hidden;">
    <div style="min-height: 300px;max-height: 300px;overflow-y: auto;">

        <?php
        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM s_notification where company_id = ' . sUser::model()->myGroup);

        if (!Yii::app()->cache->get('menunotification' . Yii::app()->user->id)) {
            $notifiche = sNotification::getUnreadNotifications();
            Yii::app()->cache->set('menunotification' . Yii::app()->user->id, $notifiche, 3600, $dependency);
        } else
            $notifiche = Yii::app()->cache->get('menunotification' . Yii::app()->user->id);

        foreach ($notifiche as $notifica) {
            echo CHtml::openTag('div', ['class' => 'media', 'style' => 'margin-top:0;']);
            echo CHtml::openTag('p', ['class' => 'pull-left', 'style' => 'width:40px']);
            echo $notifica->photoPath;
            echo CHtml::closeTag('p');

            echo CHtml::openTag('div', ['class' => 'media-body']);
            echo CHtml::openTag('p', ['class' => 'media-heading']);
            echo $notifica->linkReplace;
            echo CHtml::tag('i', ['style' => 'color:grey;font-size:11px; margin-bottom:10px;'], '  '
                . peterFunc::nicetime($notifica->expire) . ' by ' . $notifica->author_name);
            echo CHtml::closeTag('p');
            echo CHtml::closeTag('div');
            echo CHtml::closeTag('div');
        }
        ?>

        <div class="pull-right">
            <p>
                <strong><?php echo CHtml::link('<i class="fa fa-history fa-fw"></i>Notification Index', Yii::app()->createUrl('/sNotification'));
                    ?></strong>
            </p>
        </div>

    </div>
</div>

<br/>


