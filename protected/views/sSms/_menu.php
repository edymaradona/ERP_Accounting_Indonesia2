<?php

$this->menu = [
    ['label' => 'New SMS', 'icon' => 'plus', 'url' => ['/sSms/create']],
    ['label' => 'New Address Book', 'icon' => 'plus', 'url' => ['/sSms/createAddressbook']],
    ['label' => 'New Address Book Group', 'icon' => 'plus', 'url' => ['/sSms/createAddressbookGroup']],
    ['label' => 'New Single SMS', 'icon' => 'plus', 'url' => ['/sSms/createSingle']],
];

$this->menu4 = [
    ['label' => 'Inbox', 'icon' => 'inbox', 'url' => ['/sSms/inbox']],
    ['label' => 'Sent', 'icon' => 'envelope', 'url' => ['/sSms/sent']],
    ['label' => 'Queue SMS ' . CHtml::tag("span", ['class' => 'badge badge-info'], sSmsout::getPending()), 'icon' => 'envelope', 'url' => ['/sSms/queue']],
    ['label' => 'Address Book', 'icon' => 'list-alt', 'url' => ['/sSms/addressbook']],
    ['label' => 'Address Book Group', 'icon' => 'bookmark', 'url' => ['/sSms/addressbookGroup']],
];

