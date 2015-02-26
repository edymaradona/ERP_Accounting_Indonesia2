<?php /*
  <?php $this->widget('ext.tooltipster.tooltipster'); ?>

  <a href="http://www.yiiframework.com" class="tooltipster" title="This is my link's tooltip message!">
  Link
  </a>

  <div class="tooltipster" title="This is my div's tooltip message!">
  <p>This div has a tooltip when you hover over it!</p>
  </div>
 */
?>

<?php
//	$this->widget('ext.PNotify.PNotify',array( 
//		'message'=>'I am really a very simple notification')
//	);
//<script>
//$.notify("Hello World");    
//</script>


?>

<?php /*
  $cs=Yii::app()->clientScript;
  $cs->registerScriptFile(Yii::app()->baseUrl.'/css/snow-effect/snowfall.jquery.js',CClientScript::POS_END);

  Yii::app()->clientScript->registerScript('snow', "
  $(function() {
  $(document).snowfall(
  {
  flakeCount : 150,        // number
  flakeColor : '#fff', // string
  flakeIndex: 999999,     // number
  minSize : 2,            // number
  maxSize : 8,            // number
  minSpeed : 2,           // number
  maxSpeed : 6,           // number
  round : true,          // bool
  shadow : true          // bool
  }
  );


  });

  "); */
 
?>



<?php
$isExist = is_file(Yii::app()->basePath . "/views/site/theme.php");
if ($isExist) {
    $this->renderPartial('/site/theme');
}
?>

<div class="row">
    <div class="col-md-8">
        <?php
        include(Yii::app()->basePath . '/config/personalizeContent.php');
        ?>
    </div>

    <div class="col-md-4">
        <?php
        include(Yii::app()->basePath . '/config/personalizeSidebar.php');
        ?>
    </div>

</div>

