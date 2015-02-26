<?php
$this->breadcrumbs = [
    'User' => ['/sUser'],
    'Manage',
];

$this->menu5 = ['User'];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sUser']],
    ['label' => 'Rights', 'icon' => 'certificate', 'url' => ['/rights']],
    ['label' => 'Modules', 'icon' => 'briefcase', 'url' => ['/sModule']],
];

$this->menu2 = sUser::getTopCreated();
$this->menu4 = sUser::getTopLastOneHour();
?>

<div class="page-header">
    <h1>
        <i class="fa fa-user fa-fw"></i>
        User Management
    </h1>
</div>

<div class="row">
    <div class="col-md-4">

        <?php
        $Hierarchy = aOrganization::model()->findAll(['condition' => Yii::app()->params['parent_organization_filter']]);

        foreach ($Hierarchy as $Hierarchy) {
            $models = aOrganization::model()->findByPk($Hierarchy->id);
            $items[] = $models->getTreeUser();
        }

        $this->beginWidget('CTreeView', [
            'id' => 'module-tree',
            'data' => $items,
            //'url' => array('/aOrganization/ajaxFillUser'),
            //'collapsed'=>true,
            //'unique'=>true,
        ]);
        $this->endWidget();
        ?>

    </div>
    <div class="col-md-8">

        <?php
        if (isset($_GET['pid'])) {
            if ((int)$_GET['pid'] != 0) {
                echo "<b><p style='display: block;margin: 5px 0;padding: 10px;background-color: #EAEFFF;'>";
                echo "Filter By Company: " . aOrganization::model()->findByPk((int)$_GET['pid'])->name;
                echo "</p></b>";
            }
        }
        ?>

        <?php
        $this->renderPartial('_search', [
            'model' => $model,
        ]);
        ?>

        <?php
        $this->widget('zii.widgets.CListView', [
            'dataProvider' => $dataProvider,
            'sortableAttributes' => ['last_login', 'created_date'],
            'itemView' => '_view',
        ]);
        ?>

    </div>
</div>
