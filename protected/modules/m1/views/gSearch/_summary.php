<?php
$i = 0;
foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {

    if ($i > 0) {
        if (Yii::app()->session[$key]) {
            ?>
            <div id="summary_<?php echo $key; ?>"></div>
        <?php
        }
    }
    $i++;
}
?>

