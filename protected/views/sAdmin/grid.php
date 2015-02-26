<?php
$this->pageTitle = Yii::app()->name . ' - Help';
$this->breadcrumbs = [
    'Empty',
];
?>

<div class="page-header">
    <h1>
        <i class="fa fa-wrench"></i>
        Empty</h1>
</div>

<?php
		$array = [
			['id'=>'1','c1'=>'A'],
			['id'=>'2','c1'=>'B'],
		];
		$dataProvider = new CArrayDataProvider($array);

        $this->widget('booster.widgets.TbGridView', [
            'id' => 'yii-log-grid',
            'dataProvider' => $dataProvider,
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}',
            'columns' => [

        	]
        ]);

        echo json_encode($array);
?>        
