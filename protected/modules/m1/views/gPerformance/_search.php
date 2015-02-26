<style>
    .userautocompletelink {
        height: 52px;
    }

    .userautocompletelink img {
        float: left;
        margin-right: 5px;
        width: 40px;
    }

</style>


<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');


Yii::app()->clientScript->registerScript('autocom', "
        $(function() {
        $( \"#" . CHtml::activeId($model, 'employee_name') . "\" ).autocomplete({
            'minLength' : 2,
            'source': ' " . Yii::app()->createUrl('/m1/gPerson/personAutoCompletePhoto') . "',
            'focus': function( event, ui ) {
            $(\"#" . CHtml::activeId($model, 'employee_name') . "\").val(ui.item.label);
            return false;
            },
            'select': function( event, ui ) {
            window.location = '" . CHtml::normalizeUrl([$this->id . "/view"]) . "/id/'+ui.item.id;
            return false;
            },
            
        })
        .data( \"autocomplete\" )._renderItem = function( ul, item ) {
            return $( \"<li></li>\")
            .data( \"item.autocomplete\", item )
            .append('<a class=\'userautocompletelink\'><img src=\'"
    . Yii::app()->baseUrl . "/shareimages/hr/employee/thumb/" . "'+item.photo+'\'/><strong>'+item.label+'</strong><br/>'+item.department+'</a>')
            .appendTo( ul );
        };
        

});

        ");

?>


<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'action' => Yii::app()->createUrl('m1/gPerformance/index'),
    'method' => 'get',
    'type' => 'inline',
    'id' => 'searchForm',
    'htmlOptions' => ['class' => 'form-inline'],
]);
?>

<div class="input-group">
    <?php echo $form->textField($model, 'employee_name', ['width' => '100%', 'maxlength' => 100, 'placeholder' => 'Search Name', 'class' => 'form-control col-md-3']); ?>

    <span class="input-group-btn" style="width:1%">
        <?php echo CHtml::htmlButton('<i class="fa fa-search fa-fw"></i>', ['class' => 'btn btn-default', 'type' => 'button']); ?>
    </span>
</div>

<?php $this->endWidget(); ?>
<br/>

<?php
$menu99 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPerformance']],
    ['label' => 'Print', 'icon' => 'print', 'items' => [
        ['label' => 'Cover', 'icon' => 'print', 'url' => ['/m1/gPerformance/printCover', 'id' => $model->id, 'year' => $year]],
        ['label' => 'KPI', 'icon' => 'print', 'url' => ['/m1/gPerformance/printKpi', 'id' => $model->id, 'year' => $year]],
        ['label' => 'Core Competency', 'icon' => 'print', 'url' => ['/m1/gPerformance/printCore', 'id' => $model->id, 'year' => $year]],
        ['label' => 'Leadership Competency', 'icon' => 'print', 'url' => ['/m1/gPerformance/printLeadership', 'id' => $model->id, 'year' => $year]],
        ['label' => 'Final Rating', 'icon' => 'print', 'url' => ['/m1/gPerformance/printFinalRating', 'id' => $model->id, 'year' => $year]],
    ]
    ],

    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->beginWidget('booster.widgets.TbPanel', [
    'title' => 'Operation',
    'headerIcon' => 'icon-star-empty',
    'htmlOptions' => [
        'class' => 'panel-primary',
    ]
]);

$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => $menu99,
    'htmlOptions' => [
        //'style' => 'padding:0',
    ]
]);

$this->endWidget();
?>

