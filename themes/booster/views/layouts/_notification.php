<?php

$this->widget('ext.booster.widgets.TbAlert', [
    'id' => 'alert',
    //'keys'=>array('success','info','warning','error'),
    //'options'=>array(
    //'displayTime'=>5000,
    //'closeTime'=>350,
    //		'closeText'=>'x',
    //),
    //'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '&times;', // close link text - if set to false, no close link is displayed
    'alerts' => [ // configurations per alert type
        'success' => ['block' => true, 'fade' => true, 'closeText' => '&times;'], // success, info, warning, error or danger
        'info' => ['block' => true, 'fade' => true, 'closeText' => '&times;'], // success, info, warning, error or danger
        'error' => ['block' => true, 'fade' => true, 'closeText' => '&times;'], // success, info, warning, error or danger
    ],
]);
?>
