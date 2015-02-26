<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i
                class="fa fa-bars fa-fw"></i><?php echo Yii::t('basic', ' New Employee less than 3 months') ?></li>
    </ul>
</div>

<?php
$notifiche = sNotification::getReminder2();
$counter = false;

foreach ($notifiche as $key => $notifica) {

    if (($key + 2) % 2 == 0) {
        echo '<div class="row">';
    }
    ?>
    <div class="col-md-6">
        <div class="thumbnail">
            <?php echo CHtml::tag('div', [], $notifica->photoPath); ?>
            <?php /* <h5><? echo $notifica->employee_name ?></h5> */ ?>
            <p><? echo $notifica->getReminder2() ?></p>
        </div>
    </div>
    <?php
    if (($key + 1) % 2 == 0) {
        echo '</div>';
        echo '<br/>';
        $counter = false;
    } else
        $counter = true;
}
?>

<?php
if ($counter) {
    echo '</div>';
    echo '<br/>';
}
?>

</ul>

<br/>