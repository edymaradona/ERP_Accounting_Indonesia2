<?php
$this->breadcrumbs = [
    'Person',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPerson']],
    ['label' => 'Home II', 'icon' => 'home', 'url' => ['/m1/gPerson/index']],
    ['label' => 'List of Uncomplete Data', 'icon' => 'th-list', 'url' => ['/m1/default/uncomplete']],
    ['label' => 'List Candidate Transfer', 'icon' => 'th-list', 'url' => ['/m1/gPerson/requestToEmployee']],
    ['label' => 'Black List', 'icon' => 'th-list', 'url' => ['/m1/default/blacklist']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu5 = ['Person'];

//$this->menu7=array(
//		array('label'=>'All','icon'=>'list','url'=>array('/m1/gPerson')),
//		array('label'=>'Sample Dept','icon'=>'list','url'=>'#'),
//);

$this->menu7 = aOrganization::compDeptPersonFilter();

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gPerson/index')];
?>

<div class="row">
<div class="col-md-12">

    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <ul class="nav nav-list">
            <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Probation
            </li>
        </ul>
    </div>


    <?php
    $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

    if (!Yii::app()->cache->get('personprobation' . Yii::app()->user->id)) {

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria1 = new CDbCriteria;
        $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')  ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria1);
        //}

        $criteria->order = '(select end_date from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1)';

        $criteria1 = new CDbCriteria;
        $criteria1->condition = '(select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) IN(4,5)';

        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select end_date from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) < DATE_ADD(CURDATE(),INTERVAL 60 DAY)';

        $criteria->mergeWith($criteria1);
        $criteria->mergeWith($criteria2);

        $criteria->limit = 50;

        $models = gPerson::model()->findAll($criteria);

        Yii::app()->cache->set('personprobation' . Yii::app()->user->id, $models, 3600, $dependency);
    } else
        $models = Yii::app()->cache->get('personprobation' . Yii::app()->user->id);
    ?>

    <div class="row">
        <?php foreach ($models as $key => $data): ?>

            <div class="col-md-4">
                <div style="min-height:90px;">
                    <div style="float:left;width:60px;margin-right:10px;">
                        <?php echo $data->gPersonPhoto; ?>
                    </div>
                    <div>
                        <?php echo $data->gPersonLink; ?>
                        <div style="font-size:10px;">
                            <?php echo $data->mDepartment(); ?>
                            <?php //echo (isset($data->company)) ? $data->company->department->name : ''; ?>
                            <br/>
                            <?php echo $data->mStatus(); ?>
                            <br/>
                            <?php echo $data->mStatusEndDate(); ?>
                            <?php echo ' (' . $data->countContract() . ')'; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (($key + 1) % 3 == 0)
                echo '</div><div class="row">';

        endforeach;

        //if (($key+2) % 2 == 0)
        echo '</div>';
        ?>

    </div>
</div>

<div class="row">
<div class="col-md-12">

    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <ul class="nav nav-list">
            <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Contract
            </li>
        </ul>
    </div>

    <?php
    $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

    if (!Yii::app()->cache->get('personcontract' . Yii::app()->user->id)) {
        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria1 = new CDbCriteria;
        $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')  ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria1);
        //}

        $criteria->order = '(select end_date from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1)';

        $criteria1 = new CDbCriteria;
        $criteria1->condition = '(select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) IN(1,2,3)';

        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select end_date from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) < DATE_ADD(CURDATE(),INTERVAL 60 DAY)';

        $criteria->mergeWith($criteria1);
        $criteria->mergeWith($criteria2);

        $criteria->limit = 50;

        $models = gPerson::model()->findAll($criteria);

        Yii::app()->cache->set('personcontract' . Yii::app()->user->id, $models, 3600, $dependency);
    } else
        $models = Yii::app()->cache->get('personcontract' . Yii::app()->user->id);
    ?>

    <div class="row">
        <?php foreach ($models as $key => $data): ?>

            <div class="col-md-4">
                <div style="min-height:90px;">
                    <div style="float:left;width:60px;margin-right:10px;">
                        <?php echo $data->gPersonPhoto; ?>
                    </div>
                    <div>
                        <?php echo $data->gPersonLink; ?>
                        <br/>

                        <div style="font-size:10px;">
                            <?php echo $data->mDepartment(); ?>
                            <?php //echo (isset($data->company)) ? $data->company->department->name : '';  ?>
                            <br/>
                            <?php echo $data->mStatus(); ?>
                            <br/>
                            <?php echo $data->mStatusEndDate(); ?>
                            <?php echo ' (' . $data->countContract() . ')'; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (($key + 1) % 3 == 0)
                echo '</div><div class="row">';

        endforeach;

        //if (($key+2) % 2 == 0)
        echo '</div>';
        ?>

    </div>
</div>

<div class="row">
<div class="col-md-12">
    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <ul class="nav nav-list">
            <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Recently Added
            </li>
        </ul>
    </div>


    <?php
    $criteria = new CDbCriteria;

    //if (Yii::app()->user->name != "admin") {
    $criteria1 = new CDbCriteria;
    $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')  ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
    $criteria->mergeWith($criteria1);
    //}

    $criteria->order = 'created_date DESC';
    $criteria->limit = 5;


    $models = gPerson::model()->findAll($criteria);
    ?>

    <div class="row">
        <?php foreach ($models as $key => $data): ?>

            <div class="col-md-4">

                <div style="min-height:90px;">
                    <div style="float:left;width:60px;margin-right:10px;">
                        <?php echo $data->gPersonPhoto; ?>
                    </div>
                    <div>
                        <?php echo $data->gPersonLink; ?>
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
            if (($key + 1) % 2 == 0)
                echo '</div><div class="row">';

        endforeach;

        //if (($key+2) % 2 == 0)
        echo '</div>';
        ?>


    </div>
</div>
<div class="row">
<div class="col-md-12">

    <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
        <ul class="nav nav-list">
            <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Recently Updated
            </li>
        </ul>
    </div>

    <?php
    $criteria = new CDbCriteria;

    //if (Yii::app()->user->name != "admin") {
    $criteria1 = new CDbCriteria;
    $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')  ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
    $criteria->mergeWith($criteria1);
    //}

    $criteria->order = 'updated_date DESC';
    $criteria->limit = 5;

    $models = gPerson::model()->findAll($criteria);
    ?>

    <div class="row">
        <?php foreach ($models as $key => $data): ?>

            <div class="col-md-3">
                <div style="min-height:90px;">
                    <div style="float:left;width:60px;margin-right:10px;">
                        <?php echo $data->gPersonPhoto; ?>
                    </div>
                    <div>
                        <?php echo $data->gPersonLink; ?>
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
            if (($key + 1) % 3 == 0)
                echo '</div><div class="row">';

        endforeach;

        //if (($key+2) % 2 == 0)
        echo '</div>';
        ?>

    </div>
</div>

<div class="row">
    <div class="col-md-6">

        <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Employee In
                </li>
            </ul>
        </div>
        <?php
        $this->widget('booster.widgets.TbGroupGridView', [
            'extraRowColumns' => ['tMonth'],
            'id' => 'employee-grid',
            'dataProvider' => gPersonCareer::model()->employeeIn(),
            'enableSorting' => false,
            'template' => '{items}',
            'htmlOptions' => ['style' => 'padding-top:0'],
            'columns' => [
                [
                    'name' => 'tMonth',
                    'value' => 'date("M-Y", strtotime($data->start_date))',
                    'headerHtmlOptions' => ['style' => 'display: none'],
                    'htmlOptions' => ['style' => 'display: none'],
                ],
                [
                    'type' => 'raw',
                    'value' => '$data->parent->gPersonPhoto',
                    'htmlOptions' => ["width" => "60px"],
                ],
                [
                    'type' => 'raw',
                    'value' => function ($data) {
                            return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->parent->gPersonLink)
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->department->name)
                            . $data->level->name
                            . CHtml::tag('div', ['style' => 'font-weight: bold'], $data->parent->mStatus())
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], (isset($data->parent->companyfirst->start_date)) ? $data->parent->companyfirst->start_date : '')
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->parent->countJoinDate());
                        }
                ],
            ],
        ]);
        ?>

    </div>
    <div class="col-md-6">

        <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Employee Out
                </li>
            </ul>
        </div>

        <?php
        $this->widget('booster.widgets.TbGroupGridView', [
            //$this->widget('ext.groupgridview.TbGroupGridView', array(
            'extraRowColumns' => ['tMonth'],
            'id' => 'employee-grid',
            'dataProvider' => gPerson2::employeeOut(),
            'template' => '{items}',
            'enableSorting' => false,
            'htmlOptions' => ['style' => 'padding-top:0'],
            'columns' => [
                [
                    'name' => 'tMonth',
                    'value' => 'date("M-Y", strtotime($data->status->start_date))',
                    'headerHtmlOptions' => ['style' => 'display: none'],
                    'htmlOptions' => ['style' => 'display: none'],
                ],
                [
                    'type' => 'raw',
                    'value' => '$data->gPersonPhoto',
                    'htmlOptions' => ["width" => "60px"],
                ],
                [
                    'type' => 'raw',
                    'value' => function ($data) {
                            return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->gPersonLink)
                            . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->mDepartment())
                            . $data->mLevel()
                            . "</br>"
                            . $data->company->start_date
                            . " to "
                            . $data->status->start_date;
                        }
                ],
            ],
        ]);
        ?>


    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Birthday
                </li>
            </ul>
        </div>

        <?php
        $this->widget('ext.EFullCalendar.EFullCalendar', [
            // polish version available, uncomment to use it
            // 'lang'=>'pl',
            // you can create your own translation by copying locale/pl.php
            // and customizing it
            // remove to use without theme
            // this is relative path to:
            // themes/<path>
            //'themeCssFile'=>'2jui-bootstrap/jquery-ui.css',
            // raw html tags
            'htmlOptions' => [
                // you can scale it down as well, try 80%
                'style' => 'width:100%'
            ],
            // FullCalendar's options.
            // Documentation available at
            // http://arshaw.com/fullcalendar/docs/
            'options' => [
                'header' => [
                    'left' => 'prev,next',
                    //'left' => '',
                    'center' => 'title',
                    'right' => 'today'
                ],
                //'lazyFetching'=>true,
                'events' => Yii::app()->createUrl('/m1/default/calendarEvents'), // action URL for dynamic events, or
                //'events'=>[] // pass array of events directly
                // event handling
                // mouseover for example
                //'eventMouseover'=>new CJavaScriptExpression("js:function(event, element) {
                //			element.qtip({
                //				content: event.title
                //			});
                //	 } "),
            ]
        ]);
        ?>

    </div>
</div>

<?php /*
                  <div class="row">
                  <div class="col-md-8">

                  <div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
                  <ul class="nav nav-list">
                  <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Request To Employee
                  </li>
                  </ul>
                  </div>

                  <?php
                  foreach (hApplicant::model()->employeeTransferRequest()->getData() as $key=>$data): ?>
                  <?php if (($key + 3) % 3 == 0) {
                  echo "<div class='row' style='margin-bottom:10px;'>";
                  }
                  ?>

                  <div class="col-md-4">
                  <div class="row">
                  <div class="col-md-1">
                  <?php echo CHtml::link($data->PhotoPath,Yii::app()->createUrl("$this->route",array("id"=>$data->id,))); ?>
                  </div>
                  <div class="col-md-3">
                  <?php echo CHtml::link($data->applicant_name,Yii::app()->createUrl('/m1/hApplicant/view',array('id'=>$data->id)))
                  . CHtml::tag('div', [], $data->birth_date)
                  . CHtml::tag('div', [], $data->address1)
                  . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->handphone);
                  ?>
                  <?php echo CHtml::tag('div', array('style' => 'font-weight: bold'),
                  CHtml::link('Transfer',Yii::app()->createUrl('/m1/gPerson/createTransfer',array('id'=>$data->id)),
                  array('class'=>'btn btn-primary btn-xs'))
                  ) ?>
                  </div>
                  </div>
                  </div>

                  <?php
                  if (($key+4) % 3 == 0) {
                  echo "</div>";
                  echo "<br/>";
                  //echo ($key);
                  }
                  $endkey = $key;

                  endforeach;

                  if (isset($endkey) && ($endkey == 0 || ($endkey+3) % 3 != 0 )) {
                  echo "</div>";
                  echo "<br/>";
                  //echo $key;
                  }

                  ?>

                  </div>
                  </div>
                 */
?>


