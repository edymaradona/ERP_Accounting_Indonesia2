<?php
/* @var $this HApplicantController */
/* @var $data hApplicant */
?>

<div
    style="<? echo ($data->company_id != 0) ? "background-color:#D5D5D5;padding:10px;margin-bottom:10px;" : "background-color:white"; ?>">
    <h4>
        <?php
        echo CHtml::link(CHtml::encode($data->applicant_name), Yii::app()->createUrl(
            '/m1/hApplicant/view', ['id' => $data->id]));

        if ($data->vacancyLocked != 0)
            echo " [LOCKED]";
        echo ($data->company_id != 0) ? " [Not Shared]" : "";
        ?>
    </h4>
    <?php echo isset($data->company) ? $data->company->name : ""; ?>
</div>


<div class="row">
    <div class="col-md-3">
        <?php echo $data->photoPath; ?>

        <br/>
        <?php /*
          $this->widget('ext.DzRaty.DzRaty', array(
          'name'=>'star'.$data->id,
          'id'=>'star'.$data->id,
          'value' => (isset($data->systemrating)) ? $data->systemrating->rating : 0,
          //'data' => array(1,2,3,4,5,6,7,8,9,10,11,12),

          'options' => array(
          'readOnly' => TRUE,
          ),
          //'htmlOptions' => array(
          //	'class' => 'pull-right'
          //),
          )); */
        ?>

        <?php echo CHtml::tag('div', ['class' => 'pull-right', 'style' => 'color:#cbcbcb;text-size:10px'], peterFunc::nicetime($data->created_date)); ?>


    </div>
    <div class="col-md-9">
        <p>
            <?php echo CHtml::encode($data->address1); ?><br/>

            <b><?php echo CHtml::encode($data->getAttributeLabel('birth_place')); ?>:</b>
            <?php echo CHtml::encode($data->birth_place); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('birth_date')); ?>:</b>
            <?php echo CHtml::encode($data->birth_date); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('sex_id')); ?>:</b>
            <?php echo CHtml::encode($data->sex->name); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('religion_id')); ?>:</b>
            <?php echo (isset($data->religion)) ? $data->religion->name : ''; ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('handphone')); ?>:</b>
            <?php echo CHtml::encode($data->handphone); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
            <?php echo CHtml::encode($data->email); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('freshgrad_id')); ?>:</b>
            <?php echo CHtml::encode($data->freshgrad); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('expected_sallary')); ?>:</b>
            <?php echo peterFunc::indoFormat($data->expected_sallary); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('expected_position')); ?>:</b>
            <?php echo CHtml::encode($data->expected_position); ?>
            <br/>
            <?php
            if (isset($data->employee)) {
                if (in_array($data->employee->mStatus(), array('Resign', 'BlackList', 'End of Contract', 'Termination'))) {
                    echo "<strong>Former Employee at</strong>: " . $data->employee->mCompany() . " " . $data->employee->mStatus() . " since: " . $data->employee->companyfirst->start_date;
                } else
                    echo "<strong>Existing Employee at</strong>: " . $data->employee->mCompany() . " since: " . $data->employee->companyfirst->start_date;
            }
            ?>
            <br/>
            <?php
            $expC = ($data->many_experienceC != 0) ? " (" . $data->many_experienceC . ")" : "";
            $appliedC = ($data->vacancyC != 0) ? " (" . $data->vacancyC . ")" : "";
            $commentC = ($data->commentC != 0) ? " (" . $data->commentC . ")" : "";
            $selC = ($data->selectionC != 0) ? " (" . $data->selectionC . ")" : "";
            $this->widget('booster.widgets.TbTabs', [
                'type' => 'tabs', // 'tabs' or 'pills'
                'id' => 'tabs' . $data->id,
                'tabs' => [
                    ['id' => 'tab1' . $data->id, 'label' => 'Experience' . $expC, 'content' => $this->renderPartial("_viewTabExperience", ["data" => $data], true), 'active' => true],
                    ['id' => 'tab2' . $data->id, 'label' => 'Applied On' . $appliedC, 'content' => $this->renderPartial("_viewTabApplied", ["data" => $data], true)],
                    ['id' => 'tab3' . $data->id, 'label' => 'Comment' . $commentC, 'content' => $this->renderPartial("_viewTabComment", ["data" => $data], true)],
                    ['id' => 'tab4' . $data->id, 'label' => 'Selection Schedule', 'content' => $this->renderPartial("_viewTabSelectionSchedule", ["data" => $data], true)],
                    ['id' => 'tab5' . $data->id, 'label' => 'Selection Result' . $selC, 'content' => $this->renderPartial("_viewTabSelectionResult", ["data" => $data], true)],
                ],
            ]);
            ?>

        </p>
    </div>
</div>

<hr/>
