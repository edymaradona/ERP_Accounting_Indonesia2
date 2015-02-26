<?php
if (sNotification::getApproval() == null) {
    ?>

    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <h4>Waiting Your Approval</h4>
    </div>


    <ul style="margin:0">
        <?php
        $notifiche = sNotification::getApproval();

        foreach ($notifiche->getData() as $notifica) {
            echo CHtml::openTag('li', []);
            echo CHtml::openTag('div', ['class' => 'media-body']);
            echo CHtml::openTag('p', ['class' => 'media-heading']);
            //echo CHtml::tag('div',array('style'=>'width:30px;margin-right:10px;float:left'),$notifica->photoPath);
            echo CHtml::link($notifica['employee_name'], Yii::app()->createUrl('/m1/gEss/subordinate', ['id' => $notifica['id']]));
            echo " is waiting your approval";
            echo CHtml::closeTag('p');
            echo CHtml::closeTag('div');
            //echo CHtml::closeTag('div');
            echo CHtml::closeTag('li');
        }
        ?>
    </ul>

    <br/>

<?php } ?>

