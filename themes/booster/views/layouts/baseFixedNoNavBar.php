<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title><?php echo isset($this->pageTitle) ? $this->pageTitle : Yii::app()->name; ?></title>

</head>

<?php if (!Yii::app()->user->isGuest) { ?>
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }

        @media (max-width: 980px) {

            body {
                padding-top: 0px;
            }
        }

    </style>
<?php } else { ?>
<style>
    body {
        padding-top: 30px; /* 60px to make the container go all the way to the bottom of the topbar */
    }

    @media (max-width: 980px) {

        body {
            padding-top: 0px;
        }
    }

    <?php } ?>

</style>


<body>
<div class="container">

    <?php
    $this->widget('booster.widgets.TbNavbar', [
        //'fixed'=>true,
        'brand' => '',
        'collapse' => true, // requires bootstrap-responsive.css
        'items' => [

        ],
    ]);

    ?>
    <?php echo $content; ?>
</div>

<?php
if (Yii::app()->user->isGuest) {
    $this->renderPartial('//layouts/_footer');
} else
    $this->renderPartial('//layouts/_footerAuth');
?>
<?php //Yii::app()->translate->renderMissingTranslationsEditor();  ?>

</body>
</html>


