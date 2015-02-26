<?php
/* @var $this SCompanyNewsController */
/* @var $data SCompanyNews */
?>

<div class="row">
    <div class="col-md-12">
        <h4>
            <?php echo CHtml::link(CHtml::encode($data->title), Yii::app()->createUrl('/sCompanyNews/view', ['id' => $data->id])); ?>
        </h4>
    </div>
</div>

<div class="row">
    <?php //echo CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/company/logo_ONLY.jpg", CHtml::encode($data->id), array("width"=>"100%")); ?>
    <div class="col-md-12">
        <span
            class="badge badge-success"><?php echo CHtml::tag('strong', [], date('d-m-Y', strtotime($data->publish_date)) 
            . " - " . $data->created->fullName2 . " | " . $data->created->organization->name . " | " . $data->category->category_name); ?></span>

        <p>
            <?php
            $this->beginWidget('CMarkdown', ['purifyOutput' => true]);
            $_desc = peterFunc::shorten_string(strip_tags($data->content, '<br/> <br>'), 50);
            echo $_desc;
            $this->endWidget();
            ?>
        </p>
        <hr/>
    </div>
</div>
