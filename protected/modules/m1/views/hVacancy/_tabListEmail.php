<div class="row">
    <div class="col-md-8">
        <div class="btn-toolbar">
            <?php
            $this->widget('booster.widgets.TbButtonGroup', [
                'context' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'mini',
                'buttons' => [
                    ['label' => 'Action', 'items' => [
                        ['label' => 'Invitation to Interview HR', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 3])],
                        ['label' => 'Invitation to Interview HR', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 4])],
                        ['label' => 'Invitation to Psycho/Technical Test', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 5])],
                        '---',
                        ['label' => 'Psycho Test', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 6])],
                        ['label' => 'Technical Test', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 7])],
                        '---',
                        ['label' => 'Interview HR', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 8])],
                        ['label' => 'Interview User', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 9])],
                        '---',
                        ['label' => 'Salary Negotiation', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 10])],
                        ['label' => 'Letter of Offering', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', ['id' => $data->vacancy_id, 'pid' => $data->parent_id, 'act' => 11])],
                    ]],
                ],
            ]);
            ?>
        </div>
        <?php //echo CHtml::tag('div', array('style'=>'color: #999; font-size: 11px'), peterFunc::nicetime($data->created_date));
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <?php echo $data->applicant->photoPath; ?>
    </div>
    <div class="col-md-3">
        <?php
        echo CHtml::AjaxLink($data->applicant->applicant_name, Yii::app()->createUrl('/m1/hVacancy/detailApplicant', ['id' => $data->parent_id]), ['update' => '#detail']);
        echo CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->applicant->birth_date . "<br/>" .
            $data->applicant->sex->name . ' ( ' . $data->applicant->maritalStatus() . ' )' . "<br/>" .
            $data->applicant->religion->name);
        ?>
    </div>
    <div class="col-md-4">
        <?php
        echo CHtml::tag('div', ['style' => 'font-weight: bold'], (isset($data->applicant->many_experience[0])) ? $data->applicant->many_experience[0]->company_name : '');
        echo CHtml::openTag('div', ['style' => 'color: #999; font-size: 11px']);
        echo (isset($data->applicant->many_experience[0])) ? $data->applicant->many_experience[0]->industries : '';
        echo "<br/>";
        echo (isset($data->applicant->many_experience[0])) ? $data->applicant->many_experience[0]->start_date . ' to ' . $data->applicant->many_experience[0]->end_date : '';
        echo "<br/>";
        echo (isset($data->applicant->many_experience[0])) ? $data->applicant->many_experience[0]->job_title : '';
        echo CHtml::closeTag('div');
        ?>
    </div>
    <div class="col-md-3">
        <?php
        echo CHtml::tag('div', ['style' => 'font-weight: bold'], (isset($data->applicant->many_education[0])) ? $data->applicant->many_education[0]->school_name : '');
        echo CHtml::openTag('div', ['style' => 'color: #999; font-size: 11px']);
        echo (isset($data->applicant->many_education[0])) ? $data->applicant->many_education[0]->interest : '';
        echo "<br/>";
        echo (isset($data->applicant->many_education[0])) ? $data->applicant->many_education[0]->graduate : '';
        echo "<br/>";
        echo (isset($data->applicant->many_education[0])) ? $data->applicant->many_education[0]->ipk : '';
        echo CHtml::closeTag('div');
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php /*
          if ($data->email_status_id == 1) {
          echo CHtml::link('Email Invitation', Yii::app()->createUrl('/m1/hVacancy/email', array('id' => $data->id)), array('target' => '_blank', 'class' => 'btn btn-xs btn-default', 'style' => 'margin:10px'));
          } else
          echo "Emailed";
         */
        ?>

        <?php echo CHtml::link('Interview Comment', Yii::app()->createUrl('/m1/hVacancy/interviewDetail', ['id' => $data->id]), ['target' => '_blank', 'class' => 'btn btn-xs btn-default', 'style' => 'margin:10px']); ?>

    </div>
</div>
<hr/>

