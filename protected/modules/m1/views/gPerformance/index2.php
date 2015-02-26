<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPerformance']],
    ['label' => 'Home II', 'icon' => 'home', 'url' => ['/m1/gPerformance/index']],
    ['label' => 'Report', 'icon' => 'print', 'url' => ['/m1/gPerformance/report']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gPerformance/index')];
?>

<div class="row">
    <div class="col-md-12">

        <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Best Performance Last 3 Years
                </li>
            </ul>
        </div>

        .


    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Less Performance Last 3 Years
                </li>
            </ul>
        </div>

        .


    </div>
</div>


<div class="row">
    <div class="col-md-6">

        <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Recently Target Setting Added
                </li>
            </ul>
        </div>

        <?php
        $criteria = new CDbCriteria;
        $criteria->with = ['targetSetting'];
        $criteria->together = true;

        //if (Yii::app()->user->name != "admin") {
        $criteria1 = new CDbCriteria;
        $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')  ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria1);
        //}
        $criteria->order = 'targetSetting.updated_date DESC';
        $criteria->limit = 4;

        $models = gPerson::model()->findAll($criteria);
        ?>

        <div class="row">
            <?php foreach ($models as $key => $data): ?>

                <div class="col-md-6">
                    <div style="min-height:90px;">
                        <div style="float:left;width:60px;margin-right:10px;">
                            <?php echo $data->gPersonPhoto; ?>
                        </div>
                        <div>
                            <?php echo $data->gTalentLink; ?>
                            <br/>

                            <div style="font-size:10px;">
                                <?php echo $data->mDepartment(); ?>
                                <?php //echo (isset($data->company)) ? $data->company->department->name : '';   ?>
                                <br/>
                                <?php echo $data->mJobTitle(); ?>
                                <br/>
                                <?php echo $data->mLevel(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
                //if (($key + 1) % 2 == 0)
                //    echo '</div><div class="row">';

            endforeach;

            //if (($key) % 2 == 0)
            //    echo '</div>';
            ?>

        </div>
    </div>

    <div class="col-md-6">

        <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Recently Final Rating Added
                </li>
            </ul>
        </div>

        <?php
        $criteria = new CDbCriteria;
        $criteria->with = ['performance'];
        $criteria->together = true;

        //if (Yii::app()->user->name != "admin") {
        $criteria1 = new CDbCriteria;
        $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')  ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria1);
        //}
        $criteria->order = 'performance.updated_date DESC';
        $criteria->limit = 4;

        $models = gPerson::model()->findAll($criteria);
        ?>

        <div class="row">
            <?php foreach ($models as $key => $data): ?>

                <div class="col-md-6">
                    <div style="min-height:90px;">
                        <div style="float:left;width:60px;margin-right:10px;">
                            <?php echo $data->gPersonPhoto; ?>
                        </div>
                        <div>
                            <?php echo $data->gTalentLink; ?>
                            <br/>

                            <div style="font-size:10px;">
                                <?php echo $data->mDepartment(); ?>
                                <?php //echo (isset($data->company)) ? $data->company->department->name : '';   ?>
                                <br/>
                                <?php echo $data->mJobTitle(); ?>
                                <br/>
                                <?php echo $data->mLevel(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
                //if (($key + 1) % 2 == 0)
                //    echo '</div><div class="row">';

            endforeach;

            //if (($key) % 2 == 0)
            //    echo '</div>';
            ?>

        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Graphics
                </li>
            </ul>
        </div>

        .

    </div>
</div>



