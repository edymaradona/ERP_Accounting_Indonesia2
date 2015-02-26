<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title><?php echo isset($this->pageTitle) ? $this->pageTitle : Yii::app()->name; ?></title>

</head>

<?php
    Yii::app()->getClientScript()
        ->registerCssFile(Yii::app()->baseUrl . "/css/modern-business.css");

if (isset($this->message)) {
    Yii::app()->getClientScript()
        ->registerScriptFile(Yii::app()->baseUrl . "/css/ifightcrime-bootstrap-growl/jquery.bootstrap-growl.min.js");
    //->registerCssFile(Yii::app()->baseUrl . '/css/bootstrap-lightbox/jquery.simple.lightbox.css');

    Yii::app()->clientScript->registerScript('lightbox', "
					$.bootstrapGrowl('" . $this->message . "', {
					  ele: 'body', // which element to append to
					  type: 'info', // (null, 'info', 'error', 'success')
					  offset: {from: 'top', amount: 2}, // 'top', or 'bottom'
					  align: 'center', // ('left', 'right', or 'center')
					  width: 'auto', // (integer, or 'auto')
					  delay: 4000,
					  allow_dismiss: false,
					  stackup_spacing: 10 // spacing between consecutively stacked growls.
					});
		
				");
}

?>

<?php if (!Yii::app()->user->isGuest) { ?>
    <style>
        body {
            padding-top: 50px; /* 60px to make the container go all the way to the bottom of the topbar */
        }


    </style>
<?php } else { ?>
    <style>
        body {
            padding-top: 20px; /* 60px to make the container go all the way to the bottom of the topbar */
        }

    </style>

<?php } ?>


<body>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-50706580-1', 'auto');
    ga('send', 'pageview');

</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php $this->renderPartial('/layouts/_bootNavBar'); ?>
        </div>
    </div>

    <?php 
    if (!Yii::app()->user->isGuest) { ?>
                <div class="row">
                    <div class="col-md-12">
            <header id="myCarousel" class="carousel slide">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <h4 style="padding: 8px; background-color: #cbcbcb">
                            <?php
                            if (!Yii::app()->user->isGuest)
                                echo sUser::model()->myGroupName;
                            ?>
                        </h4>

                    </div>

                    <?php
                        if (Yii::app()->user->name == "admin" || sUser::model()->rightCountM > 2 ) {
                            $dependency = new CDbCacheDependency('SELECT MAX(id) FROM s_notification where company_id = ' . sUser::model()->myGroup);

                            if (!Yii::app()->cache->get('menunotification' . Yii::app()->user->id)) {
                                $notifiche = sNotification::getUnreadNotifications();
                                Yii::app()->cache->set('menunotification' . Yii::app()->user->id, $notifiche, 3600, $dependency);
                            } else
                                $notifiche = Yii::app()->cache->get('menunotification' . Yii::app()->user->id);

                            foreach ($notifiche as $notifica) {
                                echo CHtml::openTag('div', ['class' => 'item']);
                                echo CHtml::openTag('h4', ['style' => 'padding: 8px; background-color: #cbcbcb']);
                                echo peterFunc::shorten_string($notifica->linkReplace,15);
                                echo CHtml::tag('small',[]," ".peterFunc::nicetime($notifica->expire));
                                echo CHtml::closeTag('h4');
                                echo CHtml::closeTag('div');
                            }
                        }
                    ?>



                </div>
            </header>
            </div>
        </div>
    <?php } ?>

    <?php /*
              <div class="col-md-12">
              <?php $this->renderPartial('/layouts/_bootNavBarBottom'); ?>
              </div>
             */
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

    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>
</html>


