<style>
    tr.highlight {
        background: #f5f5f5;
    / / font-weight : bold;
    }

    tr.white {
        background: #FFFFFF;
    }
</style>



<?php
$this->breadcrumbs = [
    'Notification' => ['index'],
    'index',
];


$this->menu = [
//array('label'=>'Create', 'url'=>array('create')),
];

//$this->menu4=ModelNotifyii::getTopOther();
?>

<div class="page-header">
    <h1>
        <i class="fa fa-bars fa-fw"></i>
        Notification Manager
    </h1>
</div>

<div class="row">
    <div class="col-md-8">
        <?php
        if (Yii::app()->user->name == "admin" || Yii::app()->user->checkAccess('HR Unit Staff') || Yii::app()->user->checkAccess('HR Holding Staff')) {
            ?>

            <div class="pull-right">
                <?php
                $this->widget('booster.widgets.TbButtonGroup', [
                    'buttons' => [
                        ['label' => 'Mark All as Read',
                            'buttonType' => 'link',
                            'url' => Yii::app()->createUrl('/sNotification/markRead')],
                    ],
                ]);
                ?>
            </div>
            <br/>


<?php
//Yii::app()->clientScript->registerScript('refreshGridView', "
//setInterval(\"$.fn.yiiGridView.update('notification-grid')\",30000);
//");

            $this->widget('booster.widgets.TbGridView', [
                'id' => 'notification-grid',
                'dataProvider' => $dataProvider,
                'itemsCssClass' => 'table table-condensed',
                'template' => '{items}{pager}',
                'rowCssClassExpression' => '$data->cssUnread()',
                'columns' => [
                    [
                        'header' => '',
                        'type' => 'raw',
                        'value' => '$data->photoPath',
                        'htmlOptions' => [
                            'style' => 'width:40px',
                        ]
                    ],
                    [
                        'header' => 'Detail',
                        'type' => 'raw',
                        //'value' =>'$data->linkReplace',
                        'value' => function ($data) {
                                return $data->linkReplace
                                . CHtml::tag("div", ['style' => 'color:grey;font-size:12px; margin-bottom:10px;'], ($data->company_id) == 0 ? "All" : $data->company->name);
                            }
                    ],
                    [
                        'header' => 'Time',
                        'type' => 'raw',
                        'value' => function ($data) {
                                return $data->author_name
                                . CHtml::tag("div", ['style' => 'color:grey;font-size:12px;'], peterFunc::nicetime($data->expire));
                            }
                    ],
                    //'author_name',
                ],
            ]);
        }
        ?>
    </div>
    <div class="col-md-4">

        <?php
        $dir2 = Yii::app()->basePath . "/../shareimages/photo/";
        $this->widget('ext.albumPhoto', ['dir' => $dir2,
            'columns' => 2,
            'span' => 6,
            'limit' => 10,
            'header' => 5,
            'descLimit' => 10
        ]);
        ?>


    </div>
</div>


