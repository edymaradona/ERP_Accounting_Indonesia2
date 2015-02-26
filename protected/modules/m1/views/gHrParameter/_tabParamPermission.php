<div class="row">
    <div class="col-md-10">
        <?php
        $this->widget('TbGridView', [
            'id' => 'g-param-permission-grid',
            'dataProvider' => gParamPermission::model()->search(),
            //'filter'=>$model,
            'columns' => [
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'sort',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamPermissionAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'name',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamPermissionAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                    ]
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'amount',
                    //'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => [
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamPermissionAjax'),
                        'placement' => 'right',
                        'inputclass' => 'col-md-3',
                    ]
                ],
                [
                    'class' => 'TbButtonColumn',
                    'template' => '{delete}',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gHrParameter/deleteParamPermission",array("id"=>$data->id))',
                ],
                [
                    'class' => 'booster.widgets.TbEditableColumn',
                    'name' => 'status_id',
                    //we need not to set value, it will be auto-taken from source
                    // 'headerHtmlOptions' => array('style' => 'width: 60px'),
                    'editable' => [
                        'type' => 'select',
                        'url' => $this->createUrl('/m1/gHrParameter/updateParamPermissionAjax'),
                        'source' => sParameter::items('cOrganizationStatus'),
                    ]
                ],
            ],
        ]);
        ?>

        <div class="page-header">
            <h3>New Param Permission</h3>
        </div>

        <?php
        echo $this->renderPartial('_formParamPermission', ['model' => $model]);
        ?>

    </div>
</div>
