<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'form',
    //'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);

?>


<?php echo $form->errorSummary($model); ?>

<?php /*
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => [
        ['id' => 'tabb1', 'label' => 'Field List', 'content' => $this->renderPartial("/gBiPerson/_tabFieldList", ['model' => $model,'form'=>$form], true), 'active' => true],
        //['id' => 'tabb2', 'label' => 'Filter', 'content' => $this->renderPartial("/gBiPerson/_tabFilter", ['model' => $model], true)],
        //['id' => 'tabb3', 'label' => 'Limit', 'content' => $this->renderPartial("/gBiPerson/_tabLimit", ['model' => $model, 'form' => $form], true)],
        //array('id'=>'tabb4','label'=>'Help','content'=>$this->renderPartial("_helpInfo", [], true)),
    ],
]); */
?>


<?php
Yii::app()->clientScript->registerScript('fieldlist', "
$('.all-button').click(function(){
    $('.all-block').toggle('slow');
    return false;
});

$('.fieldlist-button').click(function(){
    $('.fieldlist-block').toggle('slow');
    return false;
});
$('.filter-button').click(function(){
    $('.filter-block').toggle('slow');
    return false;
});
$('.limit-button').click(function(){
    $('.limit-block').toggle('slow');
    return false;
});


");
?>

    <br/>
<?php echo CHtml::link('Show/Hide Select/Filter Block', '#', ['class' => 'all-button btn btn-xs']); ?>

    <div class="all-block" style="display:none">

        <div class="well">
            <h4>SELECT</h4>

            <?php echo CHtml::link('Show/Hide Field', '#', ['class' => 'fieldlist-button btn btn-xs']); ?>

            <div class="fieldlist-block" style="display:none">

                <?php
                $this->widget('ext.appendo.JAppendo', [
                    'id' => 'repeateEnum1',
                    'model' => $model,
                    'viewName' => '_select',
                    'labelDel' => 'Remove Row',
                    'appendoPath' => '/modules/m1/views/jAppendo/',
                    //'cssFile' => 'css/jquery.appendo2.css'
                ]);

                ?>
            </div>
        </div>

        <div class="well">

            <h4>FILTER</h4>

            <?php echo CHtml::link('Show/Hide Filter', '#', ['class' => 'filter-button btn btn-xs']); ?>

            <div class="filter-block">

                <?php
                $this->widget('ext.appendo.JAppendo', [
                    'id' => 'repeateEnum2',
                    'model' => $model,
                    'viewName' => '_filter',
                    'labelDel' => 'Remove Row',
                    'appendoPath' => '/modules/m1/views/jAppendo/',
                    //'cssFile' => 'css/jquery.appendo2.css'
                ]);
                ?>

            </div>
        </div>

        <div class="well">


            <h4>LIMIT</h4>

            <?php echo CHtml::link('Show/Hide Limit', '#', ['class' => 'limit-button btn btn-xs']); ?>

            <div class="limit-block" style="display:none">

                <?php echo $form->dropDownList($model, 'limit', ['500' => '500', '1000' => '1000', '5000' => '5000'], ['class' => 'form-control']); ?>

                <?php
                echo $form->checkboxGroup($model, 'plusResign');
                ?>

            </div>
        </div>


        <?php echo $form->checkboxGroup($model, 'export'); ?>

        <div class="form-group">
            <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>' . ' Show', ['class' => 'btn btn-primary', 'type' => 'submit']); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>

<?php if (isset($_POST['field'])) { ?>
    <br/>

    <section id="result">
        <?php
        $this->widget('ext.phpexcel.tlbExcelView', [
            'id' => 'g-bi-grid',
            'dataProvider' => $dataProvider,
            'grid_mode' => $production, // Same usage as EExcelView v0.33
            'title' => 'Employee List per ' . date('d-m-Y - H-i-s'),
            'sheetTitle' => 'Report on ' . date('m-d-Y H-i'),
            //'template'=>'{items}',
            'columns' => $field
        ]);
        ?>
    </section>

<?php
} 

