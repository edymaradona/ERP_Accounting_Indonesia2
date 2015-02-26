<?php
/* @var $this SCompanyNewsController */
/* @var $data SCompanyNews */
?>

<div class="row">
    <div class="col-md-9">
        <h4>
            <?php echo CHtml::link(CHtml::encode($data->subject), Yii::app()->createUrl('/sCompanyNews/view', ['id' => $data->id])); ?>
        </h4>
    </div>
</div>

<div class="row">
    <div class="col-md-1">
        <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/company/logo_ONLY.jpg", CHtml::encode($data->id), ["width" => "100%"]); ?>
    </div>
    <div class="col-md-8">
        <?php echo date('d-m-Y', strtotime($data->iom_date)); ?>
        <br/>
        <?php
        $this->beginWidget('CMarkdown', ['purifyOutput' => true]);
        $_desc = $data->content ? substr($data->content, 0, 420) . "..." . "</p>" : "";
        echo $_desc;
        $this->endWidget();
        ?>
        <br/>
        <br/>
    </div>
</div>
