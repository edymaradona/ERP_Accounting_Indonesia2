<div class="row">
    <div class="col-md-10">
        <?php
        $this->widget('TbGridView', [
            'id' => 'g-param-level-grid',
            'dataProvider' => gParamLevel::model()->search(),
            //'filter'=>$model,
            'columns' => [
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'sort',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamLevelAjax'),
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
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamLevelAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'golongan',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamLevelAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                    ],
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'status_id',
                    //we need not to set value, it will be auto-taken from source
                    // 'headerHtmlOptions' => array('style' => 'width: 60px'),
                    'editable' => [
                        'type' => 'select',
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamLevelAjax'),
                        'source' => sParameter::items('cOrganizationStatus'),
                    ]
                ],
            ],
        ]);
        ?>

        <div class="page-header">
            <h3>New Param Level</h3>
        </div>

        <?php
        echo $this->renderPartial('_formParamLevel', ['model' => $model]);
        ?>

    </div>
</div>