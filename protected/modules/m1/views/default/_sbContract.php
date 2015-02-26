<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Contract
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

$criteria->order = '(select end_date from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1)';

$criteria1 = new CDbCriteria;
$criteria1->condition = '(select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) IN(1,2,3)';

$criteria2 = new CDbCriteria;
$criteria2->condition = '(select end_date from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) < DATE_ADD(CURDATE(),INTERVAL 60 DAY)';

$criteria->mergeWith($criteria1);
$criteria->mergeWith($criteria2);

$models = gPerson::model()->findAll($criteria);
?>

<?php foreach ($models as $data): ?>
    <div class="detail" style="margin-bottom:10px;">
        <div class="row">
            <div class="col-md-1">
                <?php echo $data->gPersonPhoto; ?>
            </div>
            <div class="col-md-4">
                <?php echo $data->gPersonLink; ?>
                <br/>

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
<?php endforeach; ?>

