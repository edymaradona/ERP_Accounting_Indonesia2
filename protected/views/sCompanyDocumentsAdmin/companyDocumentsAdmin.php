<div class="page-header">
    <h1>
        <i class="fa fa-image"></i>
        Company Documents Administration</h1>
</div>

<?php
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', [
        'connectorRoute' => 'sCompanyDocumentsAdmin/connectorCompanyDocumentsAdmin',
    ]
);
?>