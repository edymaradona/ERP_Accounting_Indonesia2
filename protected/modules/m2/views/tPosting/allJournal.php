<?php
$this->breadcrumbs = [
    'Unposting',
];

$this->menu = [
];

$this->menu1 = tJournal::getTopUpdated(1);
$this->menu2 = tJournal::getTopCreated(1);
?>

<div class="page-header">
    <h1>
        All Journal
    </h1>
</div>

<?php
$this->renderPartial('_search', [
    'model' => $model,
]);
?>

<?php
$this->widget('DropDownRedirect', [
    'data' => tAccount::accountDetail(),
    'url' => $this->createUrl('/m2/tPosting/allJournal', array_merge($_GET, ['acc' => '__value__'])),
    'select' => (isset($_GET['acc'])) ? $_GET['acc'] : "ALL",
]);
?>
<?php //echo CHtml::link(' Refresh', $this->createUrl('/m2/tPosting/allJournal')); ?>

<?php
if (isset($_GET['acc'])) {
    if ($_GET['acc'] != null) {
        echo "<b><p style='display: block;margin: 5px 0;padding: 10px;background-color: #EAEFFF;'>";
        echo "Current Filter :  " . tAccount::model()->findByPk((int)$_GET['acc'])->account_name;
        echo "</p></b>";
        echo "</br>";
    }
}
?>


<?php
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'template' => '{items}',
    'itemView' => '_view',
]);
?>

