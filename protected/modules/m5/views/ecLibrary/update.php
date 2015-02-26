<?php
$this->breadcrumbs=array(
	'Ec Libraries'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

    $this->menu=array(
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m5/ecLibrary']],
    ['label' => 'View', 'icon' => 'edit', 'url' => ['view', 'id' => $model->id]],
    );
    ?>

<div class="page-header">
    <h1>Update Book</h1>
</div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>