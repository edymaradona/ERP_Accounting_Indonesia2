<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-bars fa-fw"></i><?php echo Yii::t('basic', ' Top Ten Library Book') ?></li>
    </ul>
</div>

<div style="overflow: hidden;">
    <div style="min-height: 200px;max-height: 200px;overflow-y: auto;">

        <?php
        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM ec_library');
        if (!Yii::app()->cache->get('esslibrary' . Yii::app()->user->id)) {
            $sql = '
	               SELECT * FROM ec_library LIMIT 10
		';

            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $rows = $command->queryAll();

            Yii::app()->cache->set('esslibrary' . Yii::app()->user->id, $rows, 3600, $dependency);
        } else
            $rows = Yii::app()->cache->get('esslibrary' . Yii::app()->user->id);
        ?>

        <?php
        foreach ($rows as $notifica) {
            echo CHtml::openTag('div', ['class' => 'media', 'style' => 'margin-top:0;']);
            echo CHtml::openTag('p', ['class' => 'pull-left', 'style' => 'width:40px']);
            //echo $notifica->photoPath;
            echo CHtml::closeTag('p');

            echo CHtml::openTag('div', ['class' => 'media-body']);
            echo CHtml::openTag('p', ['class' => 'media-heading']);
            echo CHtml::tag('strong',[], CHtml::link($notifica["title"],Yii::app()->createUrl('m5/ecLibrary/view',array('id'=>$notifica["id"]))));
            echo CHtml::tag('i', ['style' => 'color:grey;font-size:11px; margin-bottom:10px;'], ' ' . peterFunc::shorten_string($notifica["description"],20));
            echo CHtml::closeTag('p');
            echo CHtml::closeTag('div');
            echo CHtml::closeTag('div');
        }
        ?>

    </div>
</div>
<br/>


