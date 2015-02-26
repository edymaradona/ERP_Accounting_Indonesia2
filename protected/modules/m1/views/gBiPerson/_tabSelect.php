<?php

$this->widget('ext.phpexcel.tlbExcelView', [
    'id' => 'g-bi-grid',
    'dataProvider' => $dataProvider,
    'grid_mode' => $production, // Same usage as EExcelView v0.33
    'title' => 'Employee List per ' . date('d-m-Y - H-i-s'),
    'sheetTitle' => 'Report on ' . date('m-d-Y H-i'),
    //'template'=>'{items}',
    'columns' => $field
]);
