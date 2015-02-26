<?php
$this->breadcrumbs = [
    'Budget',
];
$this->menu = [
    ['label' => 'Create', 'url' => ['create']],
];
?>

<div class="pull-right">
    <div class="col-md-2">

        <?php
        $this->widget('booster.widgets.TbButtonGroup', [
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'buttons' => [
                ['label' => 'Project', 'items' => [
                    ['label' => 'C-06 CP', 'url' => Yii::app()->createUrl("/m3/aBudget")],
                    ['label' => 'C-06 RMG/ MGR', 'url' => Yii::app()->createUrl("/m3/aBudget/filter", ["id" => 300, "pro_id" => 2])],
                    '---',
                    ['label' => 'C-07 CP', 'url' => Yii::app()->createUrl("/m3/aBudget/filter", ["id" => 1001])],
                ]],
            ],
        ]);
        ?>

    </div>


    <div class="col-md-4">
        <?php
        $this->widget('booster.widgets.TbButtonGroup', [
            'buttons' => [
                ['label' => 'Budget Position', 'url' => Yii::app()->createUrl("/m3/aBudget/report1", ["id" => $id, "pro_id" => $pro_id])],
                ['label' => 'Budget Position Summary', 'url' => Yii::app()->createUrl("/m3/aBudget/report2", ["id" => $id, "pro_id" => $pro_id])],
            ],
        ]);
        ?>
    </div>

</div>

<div class="page-header">
    <h1>
        <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/balance.png') ?>
        Budget:
        <?php echo ($pro_id == 2) ? "RMG / MGR" : "CP" ?>
        <?php //echo ($id !=null or $id !=0) ? '| '.aBudget::model()->findByPk($id)->name : ''  ?>
    </h1>
</div>


<br/>

<?php if ($id == 300 || aBudget::model()->findByPk((int)$id)->childs) {
    ?>
    <div id="component">
        <?php
        echo $this->renderPartial('_component', ['id' => $id, 'pro_id' => $pro_id]);
        ?>
    </div>
    <?php
    echo $this->renderPartial('_listAF', ['id' => $id]);
    ?>

    <br/>
    <?php /*
      $this->Widget('ext.highcharts.HighchartsWidget', array(
      'options'=>array(
      'chart' => array('defaultSeriesType' => 'column'),
      'theme' => 'grid',
      'title' => array('text' => 'Budget'),
      'xAxis' => array(
      //'categories' => aBudget::model()->perBudgetModelCat($id,$pro_id)
      'categories' => aBudget::model()->perBudgetModelCat($id,1)
      ),
      'yAxis' => array(
      'title' => array('text' => 'Rupiah'),
      ),
      //'series'=>aBudget::model()->perBudgetModel($id,$pro_id),
      'series'=>aBudget::model()->perBudgetModel($id,1),
      ),
      ));
     */
    ?>

<?php
} else {
    //echo $this->renderPartial('_detail', array('id'=>$id));
}
?>
