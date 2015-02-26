<?php
$this->breadcrumbs = [
    'Photo News' => ['/site/photo'],
];
?>


<?php
$dir = Yii::app()->basePath . "/../shareimages/photo";
$contents = scandir($dir, 1);
$counter = 1;
?>

<div class="row">
    <div class="col-md-12">

        <?php /*
          $dependency = new CDirectoryCacheDependency(Yii::app()->basePath.'/../shareimages/photo/');

          if (!Yii::app()->cache->get('photolist')) {
          $photoList=$this->renderPartial("_photoRender",array('contents'=>$contents,'dir'=>$dir,'counter'=>$counter),true);

          Yii::app()->cache->set('photolist'.Yii::app()->user->id,$photoList,86400,$dependency);
          } else
          $photoList=Yii::app()->cache->get('photolist');

          echo $photoList;
         */
        ?>

        <?php
        $this->widget('ext.albumPhoto', ['dir' => Yii::app()->basePath . "/../shareimages/photo",
            'columns' => 6,
            'span' => 2,
            'limit' => 100,
            'header' => 5,
            'showDescription' => false,
            'maxHeight' => 100
        ]);
        ?>

    </div>

</div>


<?php $this->renderPartial("_tabSocNet", []) ?>
