<?php

$this->widget('booster.widgets.TbDetailView', [
    //$this->widget('ext.XDetailView', array(
    //		'ItemColumns' => 3,
    'data' => [
        'id' => 1,
        'entity_id' => $data->entity->name,
        'input_date' => $data->input_date,
        'yearmonth_periode' => $data->yearmonth_periode,
        'module' => $data->module->name,
        'user_ref' => $data->user_ref,
        'total' => peterFunc::indoFormat($data->journalSum),
        'created' => $data->created->username,
        'posted' => (isset($data->posted)) ? $data->posted->username : null,
        'cb_custom1' => $data->cb_custom1,
    ],
    'attributes' => [
        ['name' => 'entity_id', 'label' => 'Entity'],
        ['name' => 'input_date', 'label' => 'Input Date'],
        ['name' => 'yearmonth_periode', 'label' => 'Periode'],
        ['name' => 'module', 'label' => 'Module'],
        ['name' => 'cb_custom1', 'label' => $data->user_reff, 'visible' => $data->user_reff],
        ['name' => 'created', 'label' => 'Created By'],
        ['name' => 'posted', 'label' => 'Posted By', 'visible' => ($data->posted != null)],
        ['name' => 'total', 'label' => 'Total'],
    ],
]);
?>
