<div class="row">
    <div class="col-md-3">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php echo MedicalComponent::panfic("usage_claim",$model->insuranceNumber,"OP") ?></h3>
            <h6><span style="color:#999">Rawat Jalan</span></h6>
        </div>
    </div>

    <div class="col-md-3">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php echo MedicalComponent::panfic("usage_claim",$model->insuranceNumber,"IP") ?></h3>
            <h6><span style="color:#999">Rawat Inap</span></h6>
        </div>
    </div>

    <div class="col-md-3">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php echo MedicalComponent::panfic("usage_claim",$model->insuranceNumber,"DT") ?></h3>
            <h6><span style="color:#999">Rawat Gigi</span></h6>
        </div>
    </div>

    <div class="col-md-3">
        <div class="well" style="text-align: center;padding:0">
            <h3><?php echo MedicalComponent::panfic("usage_claim",$model->insuranceNumber,"MT") ?></h3>
            <h6><span style="color:#999">Melahirkan</span></h6>
        </div>
    </div>

</div>
