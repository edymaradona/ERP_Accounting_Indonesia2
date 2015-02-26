<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title><?php echo isset($this->pageTitle) ? $this->pageTitle : Yii::app()->name; ?></title>

</head>
<style>
    body {
        padding-top: 50px; /* 60px to make the container go all the way to the bottom of the topbar */
    }

    @media (max-width: 980px) {
        .my-sticky-element {
            display: none;
        }

        body {
            padding-top: 0px;
        }
    }

    .my-sticky-element.stuck {
        position: fixed;
        top: 40;
        z-index: 100;
    }


</style>

<script>
    jQuery(document).ready(function ($) {

        var $is_mobile = false;

        if ($('.my-sticky-element').css('display') == 'none') {
            $is_mobile = true;
        }

        // now i can use $is_mobile to run javascript conditionally
    });
</script>

<?php
$cs = Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl . '/css/imakewebthings/waypoints.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl . '/css/imakewebthings/sticky-elements/waypoints-sticky.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('waypoints', "
		$(function() {
			$('.my-sticky-element').waypoint('sticky',{offset: 50 });
		});

	");
?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php $this->renderPartial('/layouts/_bootNavBar'); ?>
        </div>
    </div>

    <?php echo $content; ?>

    <?php
    if (Yii::app()->user->isGuest) {
        $this->renderPartial('//layouts/_footer');;
    } else
        $this->renderPartial('//layouts/_footerAuth');;
    ?>
</div>

<?php //Yii::app()->translate->renderMissingTranslationsEditor();  ?>

</body>
</html>


