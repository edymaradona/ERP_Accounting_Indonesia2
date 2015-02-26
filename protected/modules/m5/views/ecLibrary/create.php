<?php
$this->breadcrumbs=array(
	'Ec Libraries'=>array('index'),
	'Create',
);

$this->menu=array(
);
?>

<div class="page-header">
    <h1>Create Book</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>