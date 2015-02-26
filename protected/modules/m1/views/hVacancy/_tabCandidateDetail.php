<div class="row">
    <div class="col-md-1">
        <?php echo $data->applicant->photoPath; ?>
        <?php echo CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], peterFunc::nicetime($data->created_date)); ?>
    </div>
    <div class="col-md-5">
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
