<?php
$form = $this->beginWidget(
    'booster.widgets.TbActiveForm', [
        'id' => 'myform',
        'type' => 'horizontal'
    ]
);
?>
<?php
echo $form->hiddenField($model, 'employee_status', ['name' => 'Summary[employee_status]']);
Yii::app()->session['employee_status'] = true;
?>
<?php
echo $form->hiddenField($model, 'department', ['name' => 'Summary[department]']);
Yii::app()->session['department'] = true;
?>
<?php
echo $form->hiddenField($model, 'level', ['name' => 'Summary[level]']);
Yii::app()->session['level'] = true;
?>
<?php
echo $form->hiddenField($model, 'job_title', ['name' => 'Summary[job_title]']);
Yii::app()->session['job_title'] = true;
?>
<?php
echo $form->hiddenField($model, 'religion', ['name' => 'Summary[religion]']);
Yii::app()->session['religion'] = true;
?>
<?php
echo $form->hiddenField($model, 'sex', ['name' => 'Summary[sex]']);
Yii::app()->session['sex'] = true;
?>
<?php
echo $form->hiddenField($model, 'department', ['name' => 'Summary[department]']);
Yii::app()->session['department'] = true;
?>

<div class="panel-group" id="accordion">

    <div class="panel panel-default" id="panel1">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" data-target="#keyword_search"
                   href="#keyword_search">
                    Keyword search
                </a>
            </span>
        </div>
        <div id="keyword_search" class="panel-collapse collapse in">
            <div class="panel-body">
                <?php
                $this->widget(
                    'ext.filterSearch.widgets.textField', [
                        'model' => 'gBiPerson',
                        'field' => 'employee_name',
                    ]
                );
                ?>
                <hr/>
                <?php
                $this->widget(
                    'ext.filterSearch.widgets.textField', [
                        'model' => 'gBiPerson',
                        'field' => 'employee_address',
                    ]
                );
                ?>
                <hr/>
                <?php
                $this->widget(
                    'ext.filterSearch.widgets.textField', [
                        'model' => 'gBiPerson',
                        'field' => 'email',
                    ]
                );
                ?>
                <hr/>
                <?php
                $this->widget(
                    'ext.filterSearch.widgets.textField', [
                        'model' => 'gBiPerson',
                        'field' => 'handphone',
                    ]
                );
                ?>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="panel7">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" data-target="#department"
                   href="#department">
                    Department
                </a>
            </span>
        </div>
        <div id="religion" class="panel-collapse collapse in">
            <div class="checkbox" style="display:inline">
                <div class="panel-body">
                    <?php
                    $this->widget(
                        'ext.filterSearch.widgets.CheckBoxDepartment', [
                            'type' => sUser::model()->myGroup,
                            'model' => 'gBiPerson',
                            'field' => 'department',
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div class="panel panel-default" id="panel1">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" data-target="#employee_status"
                   href="#employee_status">
                    Employee Status
                </a>
            </span>
            <label class="checkbox" style="float:right;">
                <input type="checkbox" class="employee_status_checkall">
                Check All
            </label>
        </div>
        <div id="employee_status" class="panel-collapse collapse in">
            <div class="checkbox" style="display:inline">
                <div class="panel-body">
                    <?php
                    $this->widget(
                        'ext.filterSearch.widgets.CheckBox', [
                            'type' => 'AK',
                            'field' => 'employee_status',
                            'model' => 'gBiPerson'
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="panel4">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" data-target="#level"
                   href="#level" class="collapsed">
                    Level
                </a>
            </span>
            <label class="checkbox" style="float:right;">
                <input type="checkbox" class="level_checkall">
                Check All
            </label>
        </div>
        <div id="level" class="panel-collapse collapse">
            <div class="checkbox" style="display:inline">
                <div class="panel-body">
                    <?php $level = gParamLevel::model()->findAll(['condition' => 'parent_id <> 0']); ?>
                    <?php foreach ($level as $data) { ?>
                        <label class="checkbox">
                            <input class="level" type="checkbox" name='gBiPerson[level][]'
                                   value="<?php echo $data['name'] ?>">
                            <?php echo $data['name']; ?>
                        </label>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="panel5">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" data-target="#religion"
                   href="#religion">
                    Religion
                </a>
            </span>
        </div>
        <div id="religion" class="panel-collapse collapse in">
            <div class="checkbox" style="display:inline">
                <div class="panel-body">
                    <?php
                    $this->widget(
                        'ext.filterSearch.widgets.CheckBox', [
                            'type' => 'cAgama',
                            'model' => 'gBiPerson',
                            'field' => 'religion',
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="panel6">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" data-target="#sex"
                   href="#sex">
                    Gender
                </a>
            </span>
        </div>
        <div id="religion" class="panel-collapse collapse in">
            <div class="checkbox" style="display:inline">
                <div class="panel-body">
                    <?php
                    $this->widget(
                        'ext.filterSearch.widgets.CheckBox', [
                            'type' => 'cGender',
                            'model' => 'gBiPerson',
                            'field' => 'sex',
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->endWidget(); ?>

