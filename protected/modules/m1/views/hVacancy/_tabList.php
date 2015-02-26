<div class="row">
    <div class="col-md-12">


        <div class="row">
            <div class="col-md-2">
                <?php echo $data->applicant->photoPath; ?>
                <?php echo CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], peterFunc::nicetime($data->created_date)); ?>
            </div>
            <div class="col-md-10">

                <?php if (isset($data->applicant) && $data->applicant->vacancyLocked == 0) { ?>
                    <div class="btn-toolbar pull-left">
                        <?php
                        $this->widget('booster.widgets.TbButtonGroup', [
                            'context' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                            'size' => 'mini',
                            'buttons' => [
                                ['label' => 'Action', 'items' => [
                                    ['label' => 'Invitation to Interview HR', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 21])],
                                    ['label' => 'Invitation to Interview User', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 22])],
                                    ['label' => 'Invitation to Psycho/Technical Test', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 23])],
                                    '---',
                                    ['label' => 'Interview HR', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 31])],
                                    ['label' => 'Interview User', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 32])],
                                    '---',
                                    ['label' => 'Psycho Test', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 41])],
                                    ['label' => 'Technical Test', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 42])],
                                    '---',
                                    ['label' => 'Salary Negotiation', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 52])],
                                    ['label' => 'Letter of Offering', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 53])],
                                    ['label' => 'Transfer to Employee', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 54])],
                                ]],
                            ],
                        ]);
                        ?>
                    </div>
                <?php
                } else
                    echo "LOCKED";
                ?>


                <h4>
                    <?php echo CHtml::link($data->applicant->applicant_name, Yii::app()->createUrl('/m1/hApplicant/view', ['id' => $data->parent_id]), ['style' => 'margin-left:10px']); ?>
                </h4>

                <?php
                //echo CHtml::AjaxLink($data->applicant->applicant_name,Yii::app()->createUrl('/m1/hVacancy/detailApplicant',array('id'=>$data->applicant_id)),
                //	array('update'=>'#detail'));				
                //echo CHtml::tag('strong',[],$data->applicant->applicant_name);				
                //echo CHtml::link($data->applicant->applicant_name,Yii::app()->createUrl('/m1/hApplicant/view',array('id'=>$data->applicant_id)));				
                echo CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->applicant->birth_date);
                echo CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->applicant->sex->name . ' ( ' . $data->applicant->maritalStatus() . ' )');
                echo CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->applicant->religion->name);
                echo CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->applicant->handphone);
                ?>
            </div>
        </div>

        <br/>

        <?php
        $this->widget('booster.widgets.TbGridView', [
            'id' => 'g-education-grid' . $data->parent_id,
            'dataProvider' => hApplicantEducation::model()->search($data->parent_id),
            //'filter'=>$model,
            'enableSorting' => false,
            'template' => '{items}',
            'htmlOptions' => [
                'style' => 'padding-top:0',
            ],
            'type' => 'striped condensed',
            'columns' => [
                [
                    'header' => 'Level',
                    'value' => '$data->edulevel->name',
                ],
                'school_name',
                'city',
                'interest',
                'graduate',
                //'country',
                //'institution',
                'ipk',
            ],
        ]);
        ?>

        <?php
        $this->widget('TbGridView', [
            'id' => 'g-person-experience-grid' . $data->parent_id,
            'dataProvider' => hApplicantExperience::model()->search($data->parent_id),
            'enableSorting' => false,
            'template' => '{items}',
            'htmlOptions' => [
                'style' => 'padding-top:0',
            ],
            'type' => 'striped condensed',
            'columns' => [
                'company_name',
                'industries',
                'start_date',
                'end_date',
                'job_title',
            ],
        ]);
        ?>


    </div>
</div>

<hr/>
