<h3>Career</h3>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-karir-grid',
    'dataProvider' => gPersonCareer::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        'start_date',
        [
            'header' => 'Status',
            'value' => 'isset($data->status->name) ? $data->status->name : ""',
        ],
        [
            'header' => 'Company',
            'value' => 'isset($data->company->name) ? $data->company->name : ""',
        ],
        [
            'header' => 'Department',
            'value' => 'isset($data->department->name) ? $data->department->name : ""',
        ],
        //'department_id',
        [
            'header' => 'Level',
            'value' => 'isset($data->level->name) ? $data->level->name : ""',
        ],
        'job_title',
        /*[
            'header' => 'Superior',
            'type' => 'raw',
            'value' => '($this->id != "gEss") ? $data->parent->mSuperior() : $data->parent->mSuperiorLink()',
        ],*/
        [
            'class' => 'TbButtonColumn',
            'template' => '{move}',
            'buttons' => [
                'move' => [
                    'label' => 'Move to Experience',
                    'url' => 'Yii::app()->createUrl("/m1/gPersonHolding/move",array("id"=>$data->id))',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
								$.fn.yiiGridView.update("g-karir-grid", {
									data: $(this).serialize()
								});
								$.fn.yiiGridView.update("g-person-experience-grid", {
									data: $(this).serialize()
								});
							}',
                        ],
                        'class' => 'btn btn-primary btn-xs',
                    ],
                ],
            ],
            'visible' => $this->id != "gEss",
        ],
    ],
]);
?>

<h3>Experience</h3>
<?php echo $this->renderPartial('/gPerson/_tabExperience', ["model" => $model]); ?>

<h3>Status</h3>
<?php
echo $this->renderPartial('/gPerson/_tabStatus', ["model" => $model]);
