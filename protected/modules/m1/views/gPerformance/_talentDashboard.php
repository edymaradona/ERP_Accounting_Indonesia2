<div class="row">
    <div class="col-md-3">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php
                if ($model->mGolonganId() >= 10) {
                    echo gTalentTargetSetting::calculation($model->id, $model->mGolonganId(), $year, 1) . "<br/>" .
                        gTalentTargetSetting::calculation($model->id, $model->mGolonganId(), $year, 2);
                } else
                    echo gTalentWorkResult::calculation($model->id, $model->mGolonganId(), $year, 1);
                ?>
            </h3>
            <h6><span
                    style="color:#999">Work Result/KPI <br/>Weight: <?php echo ($model->mGolonganId() >= 7) ? "70" : "50"; ?> </span>
            </h6>
        </div>
    </div>

    <div class="col-md-3">
        <div class="well" style="text-align: center;padding:0">
            <h3> <?php
                if ($model->mGolonganId() >= 10)
                    echo gTalentCoreCompetency::calculation($model->id, $model->mGolonganId(), $year, 1) . "<br/>";

                echo gTalentCoreCompetency::calculation($model->id, $model->mGolonganId(), $year, 2); ?>
            </h3>
            <h6><span
                    style="color:#999">Core Competency <br/>Weight: <?php echo ($model->mGolonganId() >= 7) ? "15" : "50"; ?></span>
            </h6>
        </div>
    </div>

    <?php if ($model->mGolonganId() > 6) { ?>
        <div class="col-md-3">
            <div class="well" style="text-align: center;padding:0">
                <h3> <?php
                    if ($model->mGolonganId() >= 10)
                        echo gTalentLeadershipCompetency::calculation($model->id, $model->mGolonganId(), $year, 1) . "<br/>";

                    echo gTalentLeadershipCompetency::calculation($model->id, $model->mGolonganId(), $year, 2); ?>
                </h3>
                <h6><span
                        style="color:#999">Leadership Competency <br/>Weight: <?php echo ($model->mGolonganId() >= 7) ? "15" : ""; ?></span>
                </h6>
            </div>
        </div>

    <?php } ?>

    <div class="col-md-3">
        <div class="well" style="text-align: center;padding:0">
            <h3>  <?php
                if ($model->mGolonganId() >= 10)
                    echo gTalentWorkResult::calculation($model->id, $model->mGolonganId(), $year, 1) +
                        gTalentTargetSetting::calculation($model->id, $model->mGolonganId(), $year, 1) +
                        gTalentCoreCompetency::calculation($model->id, $model->mGolonganId(), $year, 1) +
                        gTalentLeadershipCompetency::calculation($model->id, $model->mGolonganId(), $year, 1) . "<br/>";

                echo gTalentWorkResult::calculation($model->id, $model->mGolonganId(), $year, 2) +
                    gTalentTargetSetting::calculation($model->id, $model->mGolonganId(), $year, 2) +
                    gTalentCoreCompetency::calculation($model->id, $model->mGolonganId(), $year, 2) +
                    gTalentLeadershipCompetency::calculation($model->id, $model->mGolonganId(), $year, 2) ?>
            </h3>
            <h6><span style="color:#999">Total Value</span></h6>
        </div>
    </div>


</div>

<br/>
