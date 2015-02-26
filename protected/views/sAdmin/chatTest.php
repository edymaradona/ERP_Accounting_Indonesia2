<?php
Yii::app()->getClientScript()->registerCoreScript('jquery');
//Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . "/css/chat/js/jquery.js");
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . "/css/chat/js/chat.js");
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . "/css/chat/css/chat.css");


$this->pageTitle = Yii::app()->name . ' - Help';
$this->breadcrumbs = [
    'Empty',
];

//$_SESSION['username'] = "johndoe" // Must be already set
Yii::app()->session['username'] = 'johndoe';
?>

<div class="page-header">
    <h1>
        <i class="fa fa-wrench"></i>
        Chat</h1>
</div>

<div class="raw">
    <div class="col-md-12">

        <div id="main_container">

            <a href="javascript:void(0)" onclick="javascript:chatWith('janedoe')">Chat With Jane Doe</a>
            <a href="javascript:void(0)" onclick="javascript:chatWith('babydoe')">Chat With Baby Doe</a>
            <!-- YOUR BODY HERE -->

        </div>




    </div>
</div>
