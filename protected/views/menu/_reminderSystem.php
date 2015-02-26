<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-bars fa-fw"></i><?php echo Yii::t('basic', ' Reminder System') ?></li>
    </ul>
</div>

<div style="overflow: hidden;">
    <div style="min-height: 300px;max-height: 300px;overflow-y: auto;">

        <?php
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('remindersystem' . Yii::app()->user->id)) {
            $notifiche = sNotification::getReminder();

            Yii::app()->cache->set('remindersystem' . Yii::app()->user->id, $notifiche, 3600, $dependency);
        } else
            $notifiche = Yii::app()->cache->get('remindersystem' . Yii::app()->user->id);

        foreach ($notifiche as $notifica) {
            echo CHtml::openTag('div', ['class' => 'media', 'style' => 'margin-top:0;']);
            echo CHtml::openTag('p', ['class' => 'pull-left', 'style' => 'width:40px']);
            echo $notifica->photoPath;
            echo CHtml::closeTag('p');

            echo CHtml::openTag('div', ['class' => 'media-body']);
            echo CHtml::tag('p', ['class' => 'media-heading', 'style' => 'color:grey;'], $notifica->getReminder());
            //echo $notifica->getReminder();
            //echo CHtml::closeTag('p');
            echo CHtml::closeTag('div');
            echo CHtml::closeTag('div');
        }
        ?>


        <div class="pull-right">
            <p>
                <strong><?php echo CHtml::link('<i class="fa fa-history fa-fw"></i>Probation/Contract Index', Yii::app()->createUrl('/m1/default/probationcontract')); ?></strong>
            </p>
        </div>

    </div>
</div>

<br/>
