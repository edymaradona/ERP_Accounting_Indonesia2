<?php

return [
    ['label' => 'General Dashboard', 'icon' => 'home', 'url' => ['/menu']],
    ['label' => 'Home ESS', 'icon' => 'home', 'url' => ['/m1/gEss'], 'visible' => $this->route != 'm1/gEss/index'],
    ['label' => 'Profile', 'icon' => 'user', 'url' => ['/m1/gEss/person']],
    ['label' => 'Leave', 'icon' => 'plane', 'url' => ['/m1/gEss/leave']],
    ['label' => 'Permission', 'icon' => 'cog', 'url' => ['/m1/gEss/permission']],
    ['label' => 'Attendance', 'icon' => 'bell', 'url' => ['/m1/gEss/attendance']],
    ['label' => 'Other Menu', 'icon' => 'medkit', 'items' => [
        ['label' => 'Medical Claim', 'icon' => 'medkit', 'url' => ['/m1/gEss/medical']],
        ['label' => 'Business Travel', 'icon' => 'money', 'url' => ['/m1/gEss/expense']],
        ['label' => 'Personal Loan', 'icon' => 'usd', 'url' => ['/m1/gEss/loan']],
    ]],
    ['label' => 'Performance Appraisal | ' . $myear, 'icon' => 'thumbs-up', 'url' => ['/m1/gEss/talent']],
];
