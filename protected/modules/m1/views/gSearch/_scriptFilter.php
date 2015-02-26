<script>
    $(document).ready(function () {

        <?php
            $i = 0;
            foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {

                if ($i > 0) {
                    if(Yii::app()->session[$key]){
                    ?>
        $('.<?php echo $key; ?>_checkall:checkbox').change(function () {
            if ($(this).attr("checked")) {
                $('.<?php echo $key; ?>:checkbox').attr('checked', 'checked');
            }
            else {
                $('.<?php echo $key; ?>:checkbox').removeAttr('checked');
            }
        });
        <?php
        }
    }
    $i++;
}
?>

        $("#btn-export").click(function () {
            $('#myform').submit();
        });

        $('#myform').submit(function () {
            $.ajax({
                type: "POST",
                url: '<?php echo Yii::app()->createUrl('m1/gSearch/export'); ?>',
                data: $("#myform").serialize(), // serializes the form's elements.
                success: function (data) {
                    window.location = '<?php echo Yii::app()->createUrl('../../sharedocs/temporarydocuments/exports/'); ?>/' + data;
                }
            });

            return false;
        });

        $("input").keypress(function (e) {
            if (e.which == 13) {

                <?php
                $i = 0;
                foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {

                    if ($i > 0) {
                        if(Yii::app()->session[$key]){
                        ?>
                $.ajax({
                    type: "POST",
                    url: '<?php echo Yii::app()->createUrl("m1/gSearch/summary?type=$key"); ?>',
                    data: $("#myform").serialize(), // serializes the form's elements.
                    success: function (data) {
                        $("#summary_<?php echo $key; ?>").html(data);
                    }
                });
                <?php
                }
            }
            $i++;
        }
        ?>

                $.fn.yiiGridView.update('person-grid', {
                    type: 'GET',
                    url: '<?php echo Yii::app()->createUrl('m1/gSearch/index'); ?>',
                    data: $("#myform").serialize()
                });

                return false;
            }
        });

        $("input:checkbox").live("click", function () {

            <?php
            $i = 0;
            foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {

                if ($i > 0) {
                    if(Yii::app()->session[$key]){
                    ?>
            $.ajax({
                type: "POST",
                url: '<?php echo Yii::app()->createUrl("m1/gSearch/summary?type=$key"); ?>',
                data: $("#myform").serialize(), // serializes the form's elements.
                success: function (data) {
                    $("#summary_<?php echo $key; ?>").html(data);
                }
            });
            <?php
            }
        }
        $i++;
    }
    ?>

            $.fn.yiiGridView.update('person-grid', {
                type: 'POST',
                url: '<?php echo Yii::app()->createUrl('m1/gSearch/index'); ?>',
                data: $("#myform").serialize()
            });

        });
    });
</script>