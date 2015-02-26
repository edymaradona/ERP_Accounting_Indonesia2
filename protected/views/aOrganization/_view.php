<div
    style="<? echo ($data->status_id != 1) ? "background-color:#D5D5D5;padding:10px;margin-bottom:10px;" : "background-color:white"; ?>">

    <div class="row">
        <div class="col-md-12">
            <h5>
                <?php
                echo CHtml::link(CHtml::encode($data->name), ['view', 'id' => $data->id]);
                echo($data->topStatus);
                ?>
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?php echo $data->photoPath; ?>
        </div>
        <div class="col-md-10">
            <?php //echo CHtml::encode($data->branch_code_number); ?>
            <?php echo CHtml::encode($data->branch_code); ?>
            <br/>
            <b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
            <?php echo CHtml::encode($data->address); ?>
            <?php //echo CHtml::encode($data->kabupaten_id); ?>
            <?php //echo CHtml::encode($data->propinsi_id); ?>
            <?php echo CHtml::encode($data->pos_code); ?>
            <br/>

            <b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
            <?php echo CHtml::encode($data->phone_code_area); ?>
            <?php echo CHtml::encode($data->telephone); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
            <?php echo CHtml::encode($data->fax); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
            <?php echo CHtml::encode($data->email); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
            <?php echo CHtml::encode($data->website); ?>

        </div>
    </div>

</div>

<br/>
