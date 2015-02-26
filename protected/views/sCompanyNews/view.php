<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = [
    'Company News' => ['/sCompanyNews'],
    $model->title,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sCompanyNews']],
];

$this->menu1 = sCompanyNews::getTopUpdated();
$this->menu2 = sCompanyNews::getTopCreated();
?>

<div class="row">
    <div class="col-md-8">
        <div class="page-header">
            <h1>
                <i class="fa fa-article"></i>
                <?php echo $model->title; ?>
            </h1>
        </div>

        <?php
        echo "Posted By: " . $model->created->fullName2;
        echo "<br/>";
        echo "Posted Date: " . $model->publish_date;
        echo "<br/>";

        echo "<br/>";

        $this->beginWidget('CMarkdown', ['purifyOutput' => true]);
        //echo strip_tags($model->content,"<a> <p>");
        echo $model->content;
        $this->endWidget();
        ?>

        <br/>
        <h6>Related Story:</h6>


    </div>
    <div class="col-md-4">
        <?php $this->renderPartial("/site/_category", ['category_id' => 1]) ?>
        <?php $this->renderPartial("/site/_category", ['category_id' => 2]) ?>
        <?php $this->renderPartial("/site/_category", ['category_id' => 3]) ?>
    </div>
</div>

