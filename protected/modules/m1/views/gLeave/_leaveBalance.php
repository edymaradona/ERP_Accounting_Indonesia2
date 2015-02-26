<div class="row">
    <div class="col-md-3">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php echo $model->companyfirst->start_date ?></h3>
            <h6><span style="color:#999">Join Date</span></h6>
        </div>
    </div>

    <div class="col-md-6">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php echo (isset($model->lastLeave)) ? $model->lastLeave->start_date ." to " . $model->lastLeave->end_date : 0 ?></h3>
            <h6><span style="color:#999">Last Leave</span></h6>
        </div>
    </div>

    <div class="col-md-3">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php echo (isset($model->leaveBalance)) ? $model->leaveBalance->balance : 0 ?></h3>
            <h6><span style="color:#999">Balance</span></h6>
        </div>
    </div>

</div>
