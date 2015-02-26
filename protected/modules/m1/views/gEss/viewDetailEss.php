<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>

    <div class="page-header">
        <h1><i class="fa fa-book fa-fw"></i>
            <?php
            echo $model->getparent->learning_title . " (" . $model->partCount . ") | "
                . $model->schedule_date
            ?>
        </h1>

    </div>

    <br/>

<?php
$this->widget('ext.booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        'getparent.learning_title',
        'getparent.objective',
        'getparent.outline',
        'getparent.participant',
        'getparent.duration',
        [
            'name' => 'getparent.type_id',
            'value' => $model->getparent->type->name,
        ],
    ],
]);
?>

<?php
$this->widget('ext.booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        'trainer_name',
        'location',
        'schedule_date',
        'additional_info',
        [
            'name' => 'status_id',
            'value' => $model->status->name,
        ],
        'partCount',
    ],
]);


