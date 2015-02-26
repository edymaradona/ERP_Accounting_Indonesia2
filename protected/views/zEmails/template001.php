<html>
<body>

<p>Dear, <?php echo $param1 ?></p>

<p>To activate your account on <?php echo Yii::app()->request->HostInfo ?>, please choose one of two methods below.<br/>
    <br/>

    #1. click the link below, and your account will be activated instantly</p>
<br/>

<p><?php echo $param2 ?></p>

<br/>

<p>OR</p>
<br/>

<p>#2. copy or click the link below. </p>
<br/>

<p><?php echo Yii::app()->request->HostInfo ?>/site/activation . On that opened page, type your email address,
    copy and paste the code below and submit</p>
<br/>

<p><?php echo $param3 ?></p>

<br/>

<p>Our Privacy Policy</p>


</body>
</html>
