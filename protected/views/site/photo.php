<?php
$this->breadcrumbs = [
    'Photo News' => ['/site/photo'],
];
?>


<div class="row">
    <div class="col-md-9">

        <?php
        $this->widget('ext.albumPhoto', [
            'dir' => Yii::app()->basePath . "/../shareimages/photo",
            'columns' => 3,
            'span' => 4,
            'limit' => 6,
        ]);
        ?>

        <p>
            <strong><?php echo CHtml::link('All Photo >>', Yii::app()->createUrl('/site/photoAll')); ?></strong>
        </p>
        <hr/>

        <h3><?php echo "Business Unit Activity Info" ?></h3>

        <p><?php echo "" ?></p>


        <?php
        //$dependency = new CDirectoryCacheDependency($dir);
        //if (!Yii::app()->cache->get('photoalbumlist2' . $dir)) {
        //$photoAlbumList = $this->renderPartial("_photoAlbumRender2", array('contents' => $contents2, 'dir2' => $dir2, 'stopper' => $stopper), true);
        $this->widget('ext.albumPhotoNoLink', [
            'columns' => 4,
            'span' => 3,
            'dir' => Yii::app()->basePath . "/../shareimages/photo2/",
            'limit' => 4,
        ]);

        //Yii::app()->cache->set('photoalbumlist'.$id,$photoAlbumList,86400,$dependency);
        //} else
        //    $photoAlbumList = Yii::app()->cache->get('photoalbumlist2' . $dir);
        //echo $photoAlbumList;
        ?>


    </div>
    <div class="col-md-3">
        <?php $this->renderPartial("_category", ['category_id' => 1]) ?>
        <?php //$this->renderPartial("_category",array('category_id'=>2))   ?>
        <?php $this->renderPartial("_category", ['category_id' => 3]) ?>
    </div>

    <div class="pull-right">
        <p>
            <strong><?php echo CHtml::link('News Index', Yii::app()->createUrl('/sCompanyNews')); ?></strong>
        </p>
    </div>

</div>


<?php $this->renderPartial("_tabSocNet", []) ?>
