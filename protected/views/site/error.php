<?php
$this->pageTitle = Yii::app()->name . ' - Error';
//$this->breadcrumbs = [
//    'Error',
//];
?>

<div class="jumbotron">
    <h1>Error! <?php echo $code . " "; ?>
        <small style="color: #ff0000"><?php echo CHtml::encode($message); ?></small>
    </h1>
    <br/>

    <p>The page you requested could not be found, either contact your webmaster or try again. Use your browsers
        <b>Back</b> button to navigate to the page you have previously come from</p>

    <p><b>Or you could just press this neat little button:</b></p>
    <?php echo CHtml::link('<i class="fa fa-home fa-white"></i>Take Me Home', Yii::app()->createUrl('menu'), ["class" => "btn btn-primary btn-lg"]); ?>

    <br/>
    <br/>
    <?php if (!Yii::app()->user->isGuest) { ?>
        <p><b>You can also
                fill <?php echo CHtml::link('Feedback Form on Forum ', Yii::app()->createUrl('forum/thread/create/id/5')) ?></b>.
            Please, explain the error detail and Admin will
            reply your feedback as soon as possible. Thank You... </p>
    <?php } ?>


</div>
<br/>