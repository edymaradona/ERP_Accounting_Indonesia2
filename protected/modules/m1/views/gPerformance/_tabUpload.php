<br/>
<ul class="nav nav-list">
    <li class="nav-header"><i class="fa fa-bars fa-fw"></i>Documents Upload
    </li>
</ul>

<?php
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', [
        'connectorRoute' => 'sCompanyDocuments/connectorPersonalPerformance',
    ]
);
?>
