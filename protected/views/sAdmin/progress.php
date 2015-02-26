<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('prog', "

		$(function() {
 			var count = 0;
 			setInterval(function() {
  			count = count + 0.5;
  			$('#progressbar').progressbar({
   				value : count         
  			});
 			}, 100);
		});


		");
?>

<div id="progressbar"></div>


