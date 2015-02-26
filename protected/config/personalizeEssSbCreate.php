<?php

return [
    ['label' => 'Create New', 'icon' => 'edit', 'url' => ['updatePerson'],'items'=>[   
	    ['label' => 'New Leave', 'icon' => 'edit', 'url' => ['createLeave']],
	    ['label' => 'Switch Over Leave', 'icon' => 'edit', 'url' => ['createSwitchoverLeave']],
	    ['label' => 'Extended Leave', 'icon' => 'edit', 'url' => ['createExtendedLeave']],
	    ['label' => 'New Permission', 'icon' => 'edit', 'url' => ['createPermission']],
	    ['label' => 'New Medical', 'icon' => 'edit', 'url' => ['createMedical']],
	    ['label' => 'New Business Travel', 'icon' => 'edit', 'url' => ['createExpense']],
	    ['label' => 'New Loan', 'icon' => 'edit', 'url' => ['createLoan']],
	]],
	['label' => 'Update Profile '.$mEss->isValidProfile, 'icon' => 'edit', 'url' => ['updatePerson']],
    ['label' => 'Print', 'icon' => 'print', 'items'=> [
        ['label' => 'Print Leave History', 'icon' => 'print', 'url' => ['/m1/gEss/summaryLeave', "pid" => $mEss->id]],
        ['label' => 'Print Monthly Attendance | ' . date("Ym", strtotime(date("Y-m", strtotime($month . " month")) . "-01")),
            'icon' => 'print', 'url' => ['/m1/gEss/summaryAttendance', 'id' => $mEss->id, 'month' => $month]],
        ['label' => 'Print Medical History', 'icon' => 'print', 'url' => ['/m1/gEss/summaryMedical', "pid" => $mEss->id]],
        ['label' => 'Print Name Card Request', 'icon' => 'print', 'url' => ['/m1/gEss/otherNamecard', "pid" => $mEss->id]],
    ]],

];
