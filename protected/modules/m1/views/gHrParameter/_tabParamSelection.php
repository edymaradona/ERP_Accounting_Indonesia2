<div class="row">
    <div class="col-md-10">
        <?php
        $this->widget('TbGridView', [
            'id' => 'g-param-selection-grid',
            'dataProvider' => gParamSelection::model()->search(),
            //'filter'=>$model,
            'columns' => [
                'id',
                'parent_id',
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'sort',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamSelectionAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                        'title' => 'Custom Title',
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'name',
                    'value' => '($data->parent_id ==0) ? $data->name : "-- ".$data->name',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamSelectionAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                    ]
                ],
                [
                    'class' => 'TbButtonColumn',
                    'template' => '{delete}',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gHrParameter/deleteParamSelection",array("id"=>$data->id))',
                ],
            ],
        ]);
        ?>

        <div class="page-header">
            <h3>New Param Selection</h3>
        </div>

        <?php
        echo $this->renderPartial('_formParamSelection', ['model' => $model]);
        ?>

    </div>
</div>