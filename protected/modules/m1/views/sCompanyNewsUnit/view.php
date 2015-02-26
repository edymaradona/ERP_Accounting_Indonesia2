<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = [
    'Company News' => ['index'],
    $model->title,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/sCompanyNewsUnit']],
    ['label' => 'Update', 'icon' => 'pencil', 'url' => ['/m1/sCompanyNewsUnit/update', "id" => $model->id]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

//$this->menu1 = sCompanyNews::getTopUpdated();
//$this->menu2 = sCompanyNews::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="fa fa-article"></i>
        <?php echo $model->title; ?>
    </h1>
</div>

<?php
echo "Posted By: " . $model->created->username;
echo "<br/>";
echo "Posted Date: " . date('d-m-Y', $model->created_date);
echo "<br/>";

echo "<br/>";

$this->beginWidget('CMarkdown', ['purifyOutput' => true]);
echo $model->content;
$this->endWidget();
?>

